<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:05:46
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Health
 * Elasticsearch API name cluster.health
 */
class Health extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/_cluster/health/$index";
        }
        return "/_cluster/health";
    }

    public function getParamWhitelist(): array
    {
        return [
            'expand_wildcards',
            'level',
            'local',
            'master_timeout',
            'timeout',
            'wait_for_active_shards',
            'wait_for_nodes',
            'wait_for_events',
            'wait_for_no_relocating_shards',
            'wait_for_no_initializing_shards',
            'wait_for_status'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}