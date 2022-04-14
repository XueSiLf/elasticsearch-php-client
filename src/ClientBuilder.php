<?php
/**
 * Elasticsearch PHP client
 *
 * Author: XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/11 18:22:40
 */
declare(strict_types=1);

namespace Lava\ElasticSearch;

use Lava\ElasticSearch\Common\Exceptions\InvalidArgumentException;
use Lava\ElasticSearch\Common\Exceptions\RuntimeException;
use Lava\ElasticSearch\ConnectionPool\AbstractConnectionPool;
use Lava\ElasticSearch\ConnectionPool\Selectors\RoundRobinSelector;
use Lava\ElasticSearch\ConnectionPool\StaticNoPingConnectionPool;
use Lava\ElasticSearch\Connections\ConnectionFactory;
use Lava\ElasticSearch\Connections\ConnectionFactoryInterface;
use Lava\ElasticSearch\Handler\SwooleHandler;
use Lava\ElasticSearch\Namespaces\NamespaceBuilderInterface;
use Lava\ElasticSearch\Serializers\SmartSerializer;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ReflectionClass;

class ClientBuilder
{
    const ALLOWED_METHODS_FROM_CONFIG = ['includePortInHostHeader'];

    /**
     * @var Transport
     */
    private $transport;

    /**
     * @var callable
     */
    private $endpoint;

    /**
     * @var NamespaceBuilderInterface[]
     */
    private $registeredNamespacesBuilders = [];

    /**
     * @var ConnectionFactoryInterface
     */
    private $connectionFactory;

    /**
     * @var callable
     */
    private $handler;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var LoggerInterface
     */
    private $tracer;

    /**
     * @var string
     */
    private $connectionPool = StaticNoPingConnectionPool::class;

    /**
     * @var string
     */
    private $serializer = SmartSerializer::class;

    /**
     * @var string
     */
    private $selector = RoundRobinSelector::class;

    /**
     * @var array
     */
    private $connectionPoolArgs = [
        'randomizeHosts' => true
    ];

    /**
     * @var array
     */
    private $hosts;

    /**
     * @var array
     */
    private $connectionParams;

    /**
     * @var int
     */
    private $retries;

    /**
     * @var bool
     */
    private $sniffOnStart = false;

    /**
     * @var null|array
     */
    private $sslCert = null;

    /**
     * @var null|array
     */
    private $sslKey = null;

    /**
     * @var null|bool|string
     */
    private $sslVerification = null;

    /**
     * @var bool
     */
    private $elasticMetaHeader = true;

    /**
     * @var bool
     */
    private $includePortInHostHeader = false;

    /**
     * @var string
     */
    private $elasticClientApiVersioning;

    /**
     * Create an instance of ClientBuilder
     */
    public static function create(): ClientBuilder
    {
        return new static();
    }

    /**
     * Get the default handler
     *
     * @throws \RuntimeException
     */
    public static function defaultHandler(): callable
    {
        if (extension_loaded('swoole')) {
            $default = new SwooleHandler();
        } else {
            throw new \RuntimeException('Lava-Elasticsearch-PHP requires swoole.');
        }

        return $default;
    }

    /**
     * Get the handler instance (CurlHandler)
     *
     * @throws \RuntimeException
     */
    public static function singleHandler(): SwooleHandler
    {
        if (extension_loaded('swoole')) {
            return new SwooleHandler();
        } else {
            throw new \RuntimeException('SwooleSingle handler requires swoole.');
        }
    }

    /**
     * Set connection Factory
     *
     * @param ConnectionFactoryInterface $connectionFactory
     */
    public function setConnectionFactory(ConnectionFactoryInterface $connectionFactory): ClientBuilder
    {
        $this->connectionFactory = $connectionFactory;

        return $this;
    }

    /**
     * Set the connection pool (default is StaticNoPingConnectionPool)
     *
     * @param AbstractConnectionPool|string $connectionPool
     * @param array $args
     * @throws \InvalidArgumentException
     */
    public function setConnectionPool($connectionPool, array $args = []): ClientBuilder
    {
        if (is_string($connectionPool)) {
            $this->connectionPool = $connectionPool;
            $this->connectionPoolArgs = $args;
        } elseif (is_object($connectionPool)) {
            $this->connectionPool = $connectionPool;
        } else {
            throw new InvalidArgumentException("Serializer must be a class path or instantiated object extending AbstractConnectionPool");
        }

        return $this;
    }

    /**
     * Set the endpoint
     *
     * @param callable $endpoint
     */
    public function setEndpoint(callable $endpoint): ClientBuilder
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Register namespace
     *
     * @param NamespaceBuilderInterface $namespaceBuilder
     */
    public function registerNamespace(NamespaceBuilderInterface $namespaceBuilder): ClientBuilder
    {
        $this->registeredNamespacesBuilders[] = $namespaceBuilder;

        return $this;
    }

    /**
     * Set the transport
     *
     * @param Transport $transport
     */
    public function setTransport(Transport $transport): ClientBuilder
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Set the HTTP handler (cURL is default)
     *
     * @param mixed $handler
     */
    public function setHandler($handler): ClientBuilder
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Set the PSR-3 Logger
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): ClientBuilder
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Set the PSR-3 tracer
     *
     * @param LoggerInterface $tracer
     */
    public function setTracer(LoggerInterface $tracer): ClientBuilder
    {
        $this->tracer = $tracer;

        return $this;
    }

    /**
     * Set the serializer
     *
     * @param \Lava\Elasticsearch\Serializers\SerializerInterface|string $serializer
     */
    public function setSerializer($serializer): ClientBuilder
    {
        $this->parseStringOrObject($serializer, $this->serializer, 'SerializerInterface');

        return $this;
    }

    /**
     * Set the hosts (nodes)
     *
     * @param array $hosts
     * @return $this
     */
    public function setHosts(array $hosts): ClientBuilder
    {
        $this->hosts = $hosts;

        return $this;
    }

    /**
     * @return string
     */
    public function getElasticClientApiVersioning(): ?string
    {
        return $this->elasticClientApiVersioning;
    }

    /**
     * @param string $elasticClientApiVersioning
     */
    public function setElasticClientApiVersioning(string $elasticClientApiVersioning): void
    {
        $this->elasticClientApiVersioning = $elasticClientApiVersioning;
    }

    /**
     * Build and returns the Client object
     */
    public function build(): Client
    {
        $this->buildLoggers();

        if (is_null($this->handler)) {
            $this->handler = ClientBuilder::defaultHandler();
        }

        $sslOptions = null;
        if (isset($this->sslKey)) {
            $sslOptions['ssl_key'] = $this->sslKey;
        }
        if (isset($this->sslCert)) {
            $sslOptions['cert'] = $this->sslCert;
        }
        if (isset($this->sslVerification)) {
            $sslOptions['verify'] = $this->sslVerification;
        }

        if (!is_null($sslOptions)) {
            $sslHandler = function (callable $handler, array $sslOptions) {
                return function (array $request) use ($handler, $sslOptions) {
                    // Add our custom headers
                    foreach ($sslOptions as $key => $value) {
                        $request['client'][$key] = $value;
                    }

                    // Send the request using the handler and return the response.
                    return $handler($request);
                };
            };
            $this->handler = $sslHandler($this->handler, $sslOptions);
        }

        if (is_null($this->serializer)) {
            $this->serializer = new SmartSerializer();
        } elseif (is_string($this->serializer)) {
            $this->serializer = new $this->serializer;
        }

        $this->connectionParams['client']['x-elastic-client-meta'] = $this->elasticMetaHeader;
        $this->connectionParams['client']['port_in_header'] = $this->includePortInHostHeader;

        if (is_null($this->connectionFactory)) {
            if (is_null($this->connectionParams)) {
                $this->connectionParams = [];
            }

            // Make sure we are setting Content-Type and Accept (unless the user has explicitly
            // overridden it
            if (!isset($this->connectionParams['client']['headers'])) {
                $this->connectionParams['client']['headers'] = [];
            }
            $apiVersioning = $this->getElasticClientApiVersioning();
            if (!isset($this->connectionParams['client']['headers']['Content-Type'])) {
                if ($apiVersioning === 'true' || $apiVersioning === '1') {
                    $this->connectionParams['client']['headers']['Content-Type'] = ['application/vnd.elasticsearch+json;compatible-with=7'];
                } else {
                    $this->connectionParams['client']['headers']['Content-Type'] = ['application/json'];
                }
            }
            if (!isset($this->connectionParams['client']['headers']['Accept'])) {
                if ($apiVersioning === 'true' || $apiVersioning === '1') {
                    $this->connectionParams['client']['headers']['Accept'] = ['application/vnd.elasticsearch+json;compatible-with=7'];
                } else {
                    $this->connectionParams['client']['headers']['Accept'] = ['application/json'];
                }
            }

            $this->connectionFactory = new ConnectionFactory($this->handler, $this->connectionParams, $this->serializer, $this->logger, $this->tracer);
        }

        if (is_null($this->hosts)) {
            $this->hosts = $this->getDefaultHost();
        }

        if (is_null($this->selector)) {
            $this->selector = new RoundRobinSelector();
        } elseif (is_string($this->selector)) {
            $this->selector = new $this->selector;
        }

        $this->buildTransport();

        if (is_null($this->endpoint)) {
            $serializer = $this->serializer;

            $this->endpoint = function ($class) use ($serializer) {
                $fullPath = '\\Lava\\ElasticSearch\\Endpoints\\' . $class;

                $reflection = new ReflectionClass($fullPath);
                $constructor = $reflection->getConstructor();

                if ($constructor && $constructor->getParameters()) {
                    return new $fullPath($serializer);
                } else {
                    return new $fullPath();
                }
            };
        }

        $registeredNamespaces = [];
        foreach ($this->registeredNamespacesBuilders as $builder) {
            /**
             * @var NamespaceBuilderInterface $builder
             */
            $registeredNamespaces[$builder->getName()] = $builder->getObject($this->transport, $this->serializer);
        }

        return $this->instantiate($this->transport, $this->endpoint, $registeredNamespaces);
    }

    protected function instantiate(Transport $transport, callable $endpoint, array $registeredNamespaces): Client
    {
        return new Client($transport, $endpoint, $registeredNamespaces);
    }

    public function buildLoggers(): void
    {
        if (is_null($this->logger)) {
            $this->logger = new NullLogger();
        }

        if (is_null($this->tracer)) {
            $this->tracer = new NullLogger();
        }
    }

    private function buildTransport(): void
    {
        $connections = $this->buildConnectionsFromHosts($this->hosts);

        if (is_string($this->connectionPool)) {
            $this->connectionPool = new $this->connectionPool(
                $connections,
                $this->selector,
                $this->connectionFactory,
                $this->connectionPoolArgs
            );
        } elseif (is_null($this->connectionPool)) {
            $this->connectionPool = new StaticNoPingConnectionPool(
                $connections,
                $this->selector,
                $this->connectionFactory,
                $this->connectionPoolArgs
            );
        }

        if (is_null($this->retries)) {
            $this->retries = count($connections);
        }

        if (is_null($this->transport)) {
            $this->transport = new Transport($this->retries, $this->connectionPool, $this->logger, $this->sniffOnStart);
        }
    }

    private function parseStringOrObject($arg, &$destination, $interface): void
    {
        if (is_string($arg)) {
            $destination = new $arg;
        } elseif (is_object($arg)) {
            $destination = $arg;
        } else {
            throw new InvalidArgumentException("Serializer must be a class path or instantiated object implementing $interface");
        }
    }

    private function getDefaultHost(): array
    {
        return ['localhost:9200'];
    }

    /**
     * @return \Lava\Elasticsearch\Connections\Connection[]
     * @throws RuntimeException
     */
    private function buildConnectionsFromHosts(array $hosts): array
    {
        $connections = [];
        foreach ($hosts as $host) {
            if (is_string($host)) {
                $host = $this->prependMissingScheme($host);
                $host = $this->extractURIParts($host);
            } elseif (is_array($host)) {
                $host = $this->normalizeExtendedHost($host);
            } else {
                $this->logger->error("Could not parse host: " . print_r($host, true));
                throw new RuntimeException("Could not parse host: " . print_r($host, true));
            }

            $connections[] = $this->connectionFactory->create($host);
        }

        return $connections;
    }

    /**
     * @throws RuntimeException
     */
    private function normalizeExtendedHost(array $host): array
    {
        if (isset($host['host']) === false) {
            $this->logger->error("Required 'host' was not defined in extended format: " . print_r($host, true));
            throw new RuntimeException("Required 'host' was not defined in extended format: " . print_r($host, true));
        }

        if (isset($host['scheme']) === false) {
            $host['scheme'] = 'http';
        }
        if (isset($host['port']) === false) {
            $host['port'] = 9200;
        }
        return $host;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function extractURIParts(string $host): array
    {
        $parts = parse_url($host);

        if ($parts === false) {
            throw new InvalidArgumentException(sprintf('Could not parse URI: "%s"', $host));
        }

        if (isset($parts['port']) !== true) {
            $parts['port'] = 9200;
        }

        return $parts;
    }

    private function prependMissingScheme(string $host): string
    {
        if (!preg_match("/^https?:\/\//", $host)) {
            $host = 'http://' . $host;
        }

        return $host;
    }
}
