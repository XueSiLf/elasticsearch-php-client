<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 14:57:08
 */

namespace LavaMusic\ElasticSearch\Handler;

use LavaMusic\ElasticSearch\Handler\Exceptions\ConnectException;
use LavaMusic\ElasticSearch\Utility\Core;
use EasySwoole\HttpClient\HttpClient;

/**
 * Class SwooleClientFactory
 * Creates swoole http client from a request
 */
class SwooleClientFactory
{
    /**
     * Creates a swoole http client handle, header resource, and body resource based on a
     * transaction.
     *
     * @param array $request Request hash
     * @param null|resource $handle Optionally provide a curl handle to modify
     *
     * @return array Returns an array of the swoole http client handle, headers array, and
     *               response body handle.
     * @throws \RuntimeException when an option cannot be applied
     */
    public function __invoke(array $request, $handle = null)
    {
        $options = $this->getDefaultOptions($request);
        $this->applyMethod($request, $options);

        if (isset($request['client'])) {
            $this->applyHandlerOptions($request, $options);
        }

        $this->applyHeaders($request, $options);

        if (!$handle) {
            $handle = new HttpClient();
        }

        $headers = [];
        foreach ($options['headers'] as $name => $value) {
            if (is_array($value)) {
                $headers[$name] = array_pop($value);
            } else {
                $headers[$name] = $value;
            }
        }
        unset($options['headers']);

        return [$handle, $headers, $options];
    }

    /**
     * Creates a response hash from a cURL result.
     *
     * @param callable $handler Handler that was used.
     * @param array $request Request that sent.
     * @param array $response Response hash to update.
     * @param array $headers Headers received during transfer.
     * @param resource $body Body fopen response.
     *
     * @return array
     */
    public static function createResponse(
        callable $handler,
        array $request,
        array $response,
        array $headers,
        $body
    )
    {
        if (isset($response['transfer_stats']['url'])) {
            $response['effective_url'] = $response['transfer_stats']['url'];
        }

        if (!empty($headers)) {
            $response['headers'] = $headers;
            $response['version'] = null;
            $response['status'] = $response['http_code'];
            $response['reason'] = null;
            $response['body'] = $body;
        }

        return !empty($response['swoole']['errno']) || !isset($response['status'])
            ? self::createErrorResponse($handler, $request, $response)
            : $response;
    }

    private static function createErrorResponse(
        callable $handler,
        array $request,
        array $response
    )
    {
        $message = isset($response['err_message'])
            ? $response['err_message']
            : sprintf('swoole coruntine http client error %s: %s',
                $response['swoole']['errno'],
                isset($response['swoole']['error'])
                    ? $response['swoole']['error']
                    : 'See https://wiki.swoole.com/#/coroutine_client/http_client?id=errcode');

        $error = null;

        if (isset($response['swoole']['errno'])) {
            $error = new ConnectException($message);
        }

        return $response + [
            'status' => null,
            'reason' => null,
            'body' => null,
            'headers' => [],
            'error' => $error,
        ];
    }

    private function getDefaultOptions(array $request)
    {
        $url = Core::url($request);

        return [
            'headers' => $request['headers'],
            'http_method' => $request['http_method'],
            'url' => $url,
            'connect_timeout' => 150,
            'client' => $request['client'],
        ];
    }

    private function applyMethod(array $request, array &$options)
    {
        if (isset($request['body'])) {
            $this->applyBody($request, $options);
            return;
        }
    }

    private function applyBody(array $request, array &$options)
    {
        $contentLength = Core::firstHeader($request, 'Content-Length');
        $size = $contentLength !== null ? (int)$contentLength : null;

        // Send the body as a string if the size is less than 1MB OR if the
        // [client][swoole][body_as_string] request value is set.
        if (($size !== null && $size < 1000000) ||
            isset($request['client']['swoole']['body_as_string']) ||
            is_string($request['body'])
        ) {
            $options['body'] = Core::body($request);
            // Don't duplicate the Content-Length header
            $this->removeHeader('Content-Length', $options);
            $this->removeHeader('Transfer-Encoding', $options);
        } else {
            throw new \Exception('File upload is not currently supported.');
        }

        // Swoole http client sometimes adds a content-type by default. Prevent this.
        if (!Core::hasHeader($request, 'Content-Type')) {
            $options['headers'][] = 'Content-Type:';
        }
    }

    private function applyHeaders(array $request, array &$options)
    {
        // Remove the Accept header if one was not set
        if (!Core::hasHeader($request, 'Accept')) {
            $options['headers']['Accept'] = '';
        }
    }

    /**
     * Remove a header from the options array.
     *
     * @param string $name Case-insensitive header to remove
     * @param array $options Array of options to modify
     */
    private function removeHeader($name, array &$options)
    {
        foreach (array_keys($options['headers']) as $key) {
            if (!strcasecmp($key, $name)) {
                unset($options['headers'][$key]);
                return;
            }
        }
    }

    /**
     * Applies an array of request client options to a the options array.
     *
     * This method uses a large switch rather than double-dispatch to save on
     * high overhead of calling functions in PHP.
     */
    private function applyHandlerOptions(array $request, array &$options)
    {
        foreach ($request['client'] as $key => $value) {
            switch ($key) {
                // Violating PSR-4 to provide more room.
                case 'verify':
                    if ($value === false) {
                        $options['ssl_verify_peer'] = false;
                        continue 2;
                    }

                    // ssl_verify_peer https://wiki.swoole.com/#/server/setting?id=ssl_verify_peer
                    $options['ssl_verify_peer'] = true;

                    if (is_string($value)) {
                        // ssl_client_cert_file https://wiki.swoole.com/#/server/setting?id=ssl_client_cert_file
                        $options['ssl_cafile'] = $value;
                        if (!file_exists($value)) {
                            throw new \InvalidArgumentException(
                                "SSL CA bundle not found: $value"
                            );
                        }
                    }
                    break;

                case 'decode_content':
                    if ($value === false) {
                        continue 2;
                    }
                    $accept = Core::firstHeader($request, 'Accept-Encoding');
                    if ($accept) {
                        $options['accept-encoding'] = $accept;
                    }
                    break;

                case 'save_to':
                    throw new \InvalidArgumentException("The client option 'save_to' is not currently supported.");

                case 'timeout':
                    $options['timeout'] = $value;
                    break;

                case 'connect_timeout':
                    $options['connect_timeout'] = $value;
                    break;

                case 'proxy':
                    if (!is_array($value)) {
                        throw new \InvalidArgumentException("The format of the client option 'proxy' is not a array.");
                    } else {
                        if (!isset($value['host'])
                            || !isset($value['port'])
                            || !isset($value['user'])
                            || !isset($value['password'])
                        ) {
                            throw new \InvalidArgumentException("The client option 'proxy' is not valid.");
                        }
                        $options['proxy'] = [
                            'host' => $value['host'],
                            'port' => $value['port'],
                            'user' => $value['user'],
                            'pass' => $value['password'],
                        ];
                    }
                    break;

                case 'cert':
                    if (!file_exists($value)) {
                        throw new \InvalidArgumentException(
                            "SSL certificate not found: {$value}"
                        );
                    }
                    $options['ssl_cert'] = $value;
                    break;

                case 'ssl_key':
                    if (!file_exists($value)) {
                        throw new \InvalidArgumentException(
                            "SSL private key not found: {$value}"
                        );
                    }
                    $options['ssl_key'] = $value;
                    break;

                case 'progress':
                    throw new \InvalidArgumentException(
                        "The client option 'progress' is not currently supported."
                    );

                case 'debug':
                    if ($value) {
                        $options['verbose'] = true;
                    }
                    break;
            }
        }
    }
}