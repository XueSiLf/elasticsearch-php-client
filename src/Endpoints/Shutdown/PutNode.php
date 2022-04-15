<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:29:41
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Shutdown;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PutNode
 * Elasticsearch API name shutdown.put_node
 */
class PutNode extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_nodes/$node_id/shutdown";
        }
        throw new RuntimeException('Missing parameter for the endpoint shutdown.put_node');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): PutNode
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setNodeId($node_id): PutNode
    {
        if (isset($node_id) !== true) {
            return $this;
        }
        $this->node_id = $node_id;

        return $this;
    }
}