<?php
/**
 * Created by PhpStorm.
 * Author: XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/3/4 11:31:51
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\ConnectionPool\Selectors;

use LavaMusic\ElasticSearch\Connections\ConnectionInterface;

interface SelectorInterface
{
    /**
     * Perform logic to select a single ConnectionInterface instance from the array provided
     *
     * @param \LavaMusic\Elasticsearch\Connections\ConnectionInterface[] $connections an array of ConnectionInterface instances to choose from
     */
    public function select(array $connections): ConnectionInterface;
}

