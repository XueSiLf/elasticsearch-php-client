<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:47:35
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Refresh
 * Elasticsearch API name indices.refresh
 */
class Refresh extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_refresh";
        }
        return "/_refresh";
    }

    public function getParamWhitelist(): array
    {
        return [
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}