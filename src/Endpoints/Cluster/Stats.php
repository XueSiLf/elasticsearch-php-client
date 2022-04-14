<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:09:36
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stats
 * Elasticsearch API name cluster.stats
 */
class Stats extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_cluster/stats/nodes/$node_id";
        }
        return "/_cluster/stats";
    }

    public function getParamWhitelist(): array
    {
        return [
            'flat_settings',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setNodeId($node_id): Stats
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
