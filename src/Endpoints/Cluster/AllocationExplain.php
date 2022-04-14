<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:02:22
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class AllocationExplain
 * Elasticsearch API name cluster.allocation_explain
 */
class AllocationExplain extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cluster/allocation/explain";
    }

    public function getParamWhitelist(): array
    {
        return [
            'include_yes_decisions',
            'include_disk_info'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): AllocationExplain
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}