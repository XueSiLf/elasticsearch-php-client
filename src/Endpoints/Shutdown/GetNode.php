<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:29:15
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Shutdown;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetNode
 * Elasticsearch API name shutdown.get_node
 */
class GetNode extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_nodes/$node_id/shutdown";
        }
        return "/_nodes/shutdown";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setNodeId($node_id): GetNode
    {
        if (isset($node_id) !== true) {
            return $this;
        }
        $this->node_id = $node_id;

        return $this;
    }
}