<?php
/**
 * Created by PhpStorm.
 * Author: 黄龙辉 XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 9:40:55
 */

namespace LavaMusic\ElasticSearch\ConnectionPool\Selectors;


use LavaMusic\ElasticSearch\Connections\ConnectionInterface;

class RandomSelector implements SelectorInterface
{
    /**
     * Select a random connection from the provided array
     *
     * @param ConnectionInterface[] $connections an array of ConnectionInterface instances to choose from
     */
    public function select(array $connections): ConnectionInterface
    {
        return $connections[array_rand($connections)];
    }
}