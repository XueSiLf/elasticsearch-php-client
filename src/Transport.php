<?php
/**
 * Created by PhpStorm.
 * User: XueSi <1592328848@qq.com>
 * Date: 2022/4/11
 * Time: 9:38 下午
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch;

use LavaMusic\Elasticsearch\Common\Exceptions;
use LavaMusic\ElasticSearch\ConnectionPool\AbstractConnectionPool;
use LavaMusic\ElasticSearch\Connections\Connection;
use LavaMusic\ElasticSearch\Connections\ConnectionInterface;
use Psr\Log\LoggerInterface;

class Transport
{
    /**
     * @var AbstractConnectionPool
     */
    public $connectionPool;

    /**
     * @var LoggerInterface
     */
    private $log;

    /**
     * @var int
     */
    public $retryAttempts = 0;

    /**
     * @var Connection
     */
    public $lastConnection;

    /**
     * @var int
     */
    public $retries;

    /**
     * Transport class is responsible for dispatching requests to the
     * underlying cluster connections
     *
     * @param int $retries
     * @param bool $sniffOnStart
     * @param ConnectionPool\AbstractConnectionPool $connectionPool
     * @param \Psr\Log\LoggerInterface $log Monolog logger object
     */
    public function __construct(int $retries, AbstractConnectionPool $connectionPool, LoggerInterface $log, bool $sniffOnStart = false)
    {
        $this->log = $log;
        $this->connectionPool = $connectionPool;
        $this->retries = $retries;

        if ($sniffOnStart === true) {
            $this->log->notice('Sniff on Start.');
            $this->connectionPool->scheduleCheck();
        }
    }

    /**
     * Returns a single connection from the connection pool
     * Potentially performs a sniffing step before returning
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connectionPool->nextConnection();
    }

    /**
     * Perform a request to the Cluster
     *
     * @param string $method HTTP method to use
     * @param string $uri HTTP URI to send request to
     * @param array $params Optional query parameters
     * @param null $body Optional query body
     * @param array $options
     *
     * @return array
     *
     * @throws Common\Exceptions\NoNodesAvailableException|\Exception
     */
    public function performRequest(string $method, string $uri, array $params = [], $body = null, array $options = [])
    {
        try {
            $connection = $this->getConnection();
        } catch (Exceptions\NoNodesAvailableException $exception) {
            $this->log->critical('No alive nodes found in cluster');
            throw $exception;
        }

        $this->lastConnection = $connection;

        try {
            $response = $connection->performRequest(
                $method,
                $uri,
                $params,
                $body,
                $options,
                $this
            );
            // onSuccess
            $this->retryAttempts = 0;
            // Note, this could be a 4xx or 5xx error
        } catch (\Throwable $throwable) {
            throw $throwable;
            // onFailure
//            $code = $throwable->getCode();
//            // Ignore 400 level errors, as that means the server responded just fine
//            if ($code < 400 || $code >= 500) {
//                // Otherwise schedule a check
//                $this->connectionPool->scheduleCheck();
//            }
        }

        return $response;
    }

    public function shouldRetry(array $request): bool
    {
        if ($this->retryAttempts < $this->retries) {
            $this->retryAttempts += 1;

            return true;
        }

        return false;
    }

    /**
     * Returns the last used connection so that it may be inspected.  Mainly
     * for debugging/testing purposes.
     */
    public function getLastConnection(): ConnectionInterface
    {
        return $this->lastConnection;
    }
}
