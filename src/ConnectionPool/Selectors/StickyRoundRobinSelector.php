<?php
/**
 * Created by PhpStorm.
 * Author: 黄龙辉 XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 9:41:22
 */

namespace LavaMusic\ElasticSearch\ConnectionPool\Selectors;

use LavaMusic\ElasticSearch\Connections\ConnectionInterface;

class StickyRoundRobinSelector implements SelectorInterface
{
    /**
     * @var int
     */
    private $current = 0;

    /**
     * @var int
     */
    private $currentCounter = 0;

    /**
     * Use current connection unless it is dead, otherwise round-robin
     *
     * @param ConnectionInterface[] $connections Array of connections to choose from
     */
    public function select(array $connections): ConnectionInterface
    {
        /**
         * @var ConnectionInterface[] $connections
         */
        if ($connections[$this->current]->isAlive()) {
            return $connections[$this->current];
        }

        $this->currentCounter += 1;
        $this->current = $this->currentCounter % count($connections);

        return $connections[$this->current];
    }
}