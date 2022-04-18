<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 14:49:30
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\SearchableSnapshots;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearCache
 * Elasticsearch API name searchable_snapshots.clear_cache
 */
class ClearCache extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_searchable_snapshots/cache/clear";
        }
        return "/_searchable_snapshots/cache/clear";
    }

    public function getParamWhitelist(): array
    {
        return [
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'index'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}