<?php
/**
 * Created by PhpStorm.
 * Author: 黄龙辉 XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 9:40:31
 */

namespace LavaMusic\ElasticSearch\ConnectionPool\Selectors;

use LavaMusic\ElasticSearch\Connections\ConnectionInterface;

class RoundRobinSelector implements SelectorInterface
{
    /**
     * @var int
     */
    private $current = 0;

    /**
     * Select the next connection in the sequence
     *
     * @param ConnectionInterface[] $connections an array of ConnectionInterface instances to choose from
     */
    public function select(array $connections): ConnectionInterface
    {
        $returnConnection = $connections[$this->current % count($connections)];

        $this->current += 1;

        return $returnConnection;
    }
}