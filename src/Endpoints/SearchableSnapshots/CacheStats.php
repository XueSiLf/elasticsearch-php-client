<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 14:48:42
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\SearchableSnapshots;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class CacheStats
 * Elasticsearch API name searchable_snapshots.cache_stats
 */
class CacheStats extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_searchable_snapshots/$node_id/cache/stats";
        }
        return "/_searchable_snapshots/cache/stats";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setNodeId($node_id): CacheStats
    {
        if (isset($node_id) !== true) {
            return $this;
        }
        if (is_array($node_id) === true) {
            $node_id = implode(",", $node_id);
        }
        $this->node_id = $node_id;

        return $this;
    }
}