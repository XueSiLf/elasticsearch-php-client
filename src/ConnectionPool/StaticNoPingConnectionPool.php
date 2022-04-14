<?php
/**
 * Created by PhpStorm.
 * Author: 黄龙辉 XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 9:37:23
 */

namespace LavaMusic\ElasticSearch\ConnectionPool;

use LavaMusic\ElasticSearch\Common\Exceptions\NoNodesAvailableException;
use LavaMusic\ElasticSearch\ConnectionPool\Selectors\SelectorInterface;
use LavaMusic\ElasticSearch\Connections\Connection;
use LavaMusic\ElasticSearch\Connections\ConnectionFactoryInterface;
use LavaMusic\ElasticSearch\Connections\ConnectionInterface;

class StaticNoPingConnectionPool extends AbstractConnectionPool implements ConnectionPoolInterface
{
    /**
     * @var int
     */
    private $pingTimeout = 60;

    /**
     * @var int
     */
    private $maxPingTimeout = 3600;

    /**
     * {@inheritdoc}
     */
    public function __construct($connections, SelectorInterface $selector, ConnectionFactoryInterface $factory, $connectionPoolParams)
    {
        parent::__construct($connections, $selector, $factory, $connectionPoolParams);
    }

    public function nextConnection(bool $force = false): ConnectionInterface
    {
        $total = count($this->connections);
        while ($total--) {
            /**
             * @var Connection $connection
             */
            $connection = $this->selector->select($this->connections);
            if ($connection->isAlive() === true) {
                return $connection;
            }

            if ($this->readyToRevive($connection) === true) {
                return $connection;
            }
        }

        throw new NoNodesAvailableException("No alive nodes found in your cluster");
    }

    public function scheduleCheck(): void
    {
    }

    private function readyToRevive(Connection $connection): bool
    {
        $timeout = min(
            $this->pingTimeout * pow(2, $connection->getPingFailures()),
            $this->maxPingTimeout
        );

        if ($connection->getLastPing() + $timeout < time()) {
            return true;
        } else {
            return false;
        }
    }
}