<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:19:19
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\DanglingIndices;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ListDanglingIndices
 * Elasticsearch API name dangling_indices.list_dangling_indices
 */
class ListDanglingIndices extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_dangling";
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}