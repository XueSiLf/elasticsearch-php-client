<?php
/**
 * Created by PhpStorm.
 * Author: XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/3/4 11:31:51
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Connections;

interface ConnectionFactoryInterface
{
    public function create(array $hostDetails): ConnectionInterface;
}
