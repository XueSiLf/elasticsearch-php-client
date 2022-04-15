<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:28:01
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearCache
 * Elasticsearch API name indices.clear_cache
 */
class ClearCache extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_cache/clear";
        }
        return "/_cache/clear";
    }

    public function getParamWhitelist(): array
    {
        return [
            'fielddata',
            'fields',
            'query',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'index',
            'request'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}