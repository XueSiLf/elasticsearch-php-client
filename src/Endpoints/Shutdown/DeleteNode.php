<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:28:27
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Shutdown;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteNode
 * Elasticsearch API name shutdown.delete_node
 */
class DeleteNode extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_nodes/$node_id/shutdown";
        }
        throw new RuntimeException('Missing parameter for the endpoint shutdown.delete_node');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setNodeId($node_id): DeleteNode
    {
        if (isset($node_id) !== true) {
            return $this;
        }
        $this->node_id = $node_id;

        return $this;
    }
}
