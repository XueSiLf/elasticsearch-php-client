<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:14:18
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Nodes;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Info
 * Elasticsearch API name nodes.info
 */
class Info extends AbstractEndpoint
{
    protected $node_id;
    protected $metric;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;
        $metric = $this->metric ?? null;

        if (isset($node_id) && isset($metric)) {
            return "/_nodes/$node_id/$metric";
        }
        if (isset($node_id)) {
            return "/_nodes/$node_id";
        }
        if (isset($metric)) {
            return "/_nodes/$metric";
        }
        return "/_nodes";
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

    public function setNodeId($node_id): Info
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

    public function setMetric($metric): Info
    {
        if (isset($metric) !== true) {
            return $this;
        }
        if (is_array($metric) === true) {
            $metric = implode(",", $metric);
        }
        $this->metric = $metric;

        return $this;
    }
}