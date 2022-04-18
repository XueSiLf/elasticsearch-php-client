<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:05:20
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\SearchableSnapshots;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stats
 * Elasticsearch API name searchable_snapshots.stats
 */
class Stats extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_searchable_snapshots/stats";
        }
        return "/_searchable_snapshots/stats";
    }

    public function getParamWhitelist(): array
    {
        return [
            'level'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}