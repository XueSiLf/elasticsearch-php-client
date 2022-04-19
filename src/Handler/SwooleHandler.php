<?php
/**
 * Created by PhpStorm.
 * User: XueSi <1592328848@qq.com>
 * Date: 2022/4/11
 * Time: 8:57 下午
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Handler;

use LavaMusic\ElasticSearch\Utility\Core;
use EasySwoole\HttpClient\Bean\Response;
use EasySwoole\HttpClient\HttpClient;
use Swoole\Coroutine\Http\Client as CoroutineClient;

class SwooleHandler
{
    /** @var callable */
    private $factory;

    /** @var array Array of swoole http client easy handles */
    private $handles = [];

    /** @var array Array of owned swoole http client easy handles */
    private $ownedHandles = [];

    /** @var int Total number of idle handles to keep in cache */
    private $maxHandles;

    /**
     * Accepts an associative array of options:
     *
     * - factory: Optional callable factory used to create swoole http client handles.
     *   The callable is passed a request hash when invoked, and returns an
     *   array of the swoole http client handle, headers resource, and body resource.
     * - max_handles: Maximum number of idle handles (defaults to 5).
     *
     * @param array $options Array of options to use with the handler
     */
    public function __construct(array $options = [])
    {
        $this->handles = [];
        $this->factory = isset($options['handle_factory'])
            ? $options['handle_factory']
            : new SwooleClientFactory();
        $this->maxHandles = isset($options['max_handles'])
            ? $options['max_handles']
            : 5;
    }

    public function __destruct()
    {
        foreach ($this->handles as $handle) {
            if ($handle instanceof HttpClient) {
                $client = $handle->getClient();
                if ($client && $client instanceof CoroutineClient) {
                    $client->close();
                }
            }
        }
    }

    /**
     * @param array $request
     *
     * @return array
     */
    public function __invoke(array $request)
    {
        return $this->_invokeAsArray($request);
    }

    /**
     * @param array $request
     * @return array
     * @throws \EasySwoole\HttpClient\Exception\InvalidUrl
     * @internal
     *
     */
    public function _invokeAsArray(array $request)
    {
        /** @var SwooleClientFactory $factory */
        $factory = $this->factory;

        // Ensure headers are by reference. They're updated elsewhere.
        $result = $factory($request, $this->checkoutEasyHandle());

        /** @var HttpClient $client */
        $client = $result[0]; // swoole http client resource
        $headers = $result[1]; // header array
        $options = $result[2]; // request options
        $clientOptions = $options['client'];

        // handle verify
        if (isset($options['ssl_verify_peer']) && $options['ssl_verify_peer'] === true) {
            if (!isset($options['ssl_cert']) || !isset($options['ssl_key'])) {
                throw new \Exception('The option cert or ssl_key is not set.');
            }
            $client->setSslCertFile($options['ssl_cert']);
            $client->setSslKeyFile($options['ssl_key']);
            $client->setSslVerifyPeer(true,true);
            $client->setSslCafile($options['ssl_cafile']);
        }

        // handle decode_content
        if (isset($options['accept-encoding'])) {
            $headers['Accept-Encoding'] = [$options['accept-encoding']];
        }

        // handle timeout
        if (isset($options['timeout'])) {
            $client->setTimeout((float)($options['timeout']));
        }

        // handle connect_time
        if (isset($options['connect_timeout'])) {
            $client->setConnectTimeout((float)($options['connect_timeout']));
        }

        // handle proxy
        if (isset($options['proxy'])) {
            $proxyOption = $options['proxy'];
            $client->setProxyHttp($proxyOption['host'], $proxyOption['port'], $proxyOption['user'], $proxyOption['pass']);
        }

        // 延迟请求
        Core::doSleep($request);

        $httpMethod = strtolower($options['http_method']);

        $body = $request['body'];
        $scheme = $request['scheme'];
        $host = $headers['Host'];

        // $xElasticClientMetaStatus = $clientOptions['x-elastic-client-meta'];
        $port = $clientOptions['swoole']['port'];

        if (isset($clientOptions['swoole']['encoding'])) {
            $headers['Encoding'] = $clientOptions['swoole']['encoding'];
        }

        if (isset($clientOptions['swoole']['http_auth']) && $clientOptions['swoole']['http_auth'] === 'http_auth') {
            if (!isset($clientOptions['swoole']['user_pwd_str']) || empty($clientOptions['swoole']['user_pwd_str'])) {
                throw new \Exception('The user or password params is empty when use http basic auth.');
            }
            $userPwdArr = explode(':', $clientOptions['swoole']['user_pwd_str']);
            if (count($userPwdArr) !== 2) {
                throw new \Exception('The user or password params is empty when use http basic auth.');
            }
            $client->setBasicAuth($userPwdArr[0], $userPwdArr[1]);
        }

        $hostPortStr = "{$host}:{$port}";
        if (isset($clientOptions['port_in_header']) && $clientOptions['port_in_header'] === true) {
            $hostPortStr = $host;
        }

        $url = "{$scheme}://$hostPortStr";

        if ($scheme == 'https') {
            $client->setEnableSSL(true);
        }

        $client->setUrl($url);
        $client->setPath($request['uri']);
        $client->setHeaders($headers, false, false);

        switch ($httpMethod) {
            case 'put':
                /** @var Response $responseBean */
                $responseBean = $client->put($body);
                break;
            case 'delete':
                /** @var Response $responseBean */
                $responseBean = $client->delete();
                break;
            case 'get':
                /** @var Response $responseBean */
                $responseBean = $client->get();
                break;
            case 'post':
                /** @var Response $responseBean */
                $responseBean = $client->post($body);
                break;
            case 'head':
                /** @var Response $responseBean */
                $responseBean = $client->head();
                break;
        }

        $responseHeader = $responseBean->getHeaders() ?: [];
        $responseBody = $responseBean->getBody();

        $transferStats = [
            'primary_port' => $port,
            'url' => $url . $request['uri'],
        ];

        $response = [
            'transfer_stats' => array_merge($transferStats, $responseHeader),
            'http_code' => $responseBean->getStatusCode(),
            'request_headers' => $responseBean->getRequestHeaders(),
        ];
        $response['swoole']['error'] = $responseBean->getErrMsg();
        $response['swoole']['errno'] = $responseBean->getErrCode();
        $response['transfer_stats'] = array_merge($response['transfer_stats'], $response['swoole']);

        $this->releaseEasyHandle($client);

        return SwooleClientFactory::createResponse([$this, '_invokeAsArray'], $request, $response, $headers, $responseBody);
    }

    private function checkoutEasyHandle()
    {
        // Find an unused handle in the cache
        if (false !== ($key = array_search(false, $this->ownedHandles, true))) {
            $this->ownedHandles[$key] = true;
            return $this->handles[$key];
        }

        // Add a new handle
        $handle = new HttpClient();
        $id = spl_object_id($handle);
        $this->handles[$id] = $handle;
        $this->ownedHandles[$id] = true;

        return $handle;
    }

    private function releaseEasyHandle($handle)
    {
        $id = spl_object_id($handle);

        $httpClient = $this->handles[$id];
        $this->closeSwooleClient($httpClient);

        if (count($this->ownedHandles) > $this->maxHandles) {
            unset($this->handles[$id], $this->ownedHandles[$id]);
        } else {
            $this->ownedHandles[$id] = false;
        }
    }

    private function closeSwooleClient($httpClient)
    {
        if ($httpClient instanceof HttpClient) {
            $swooleClient = $httpClient->getClient();
            if ($swooleClient && $swooleClient instanceof CoroutineClient) {
                $swooleClient->close();
            }
        }
    }
}
