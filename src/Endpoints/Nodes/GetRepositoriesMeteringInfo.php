<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:13:18
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Nodes;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetRepositoriesMeteringInfo
 * Elasticsearch API name nodes.get_repositories_metering_info
 */
class GetRepositoriesMeteringInfo extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_nodes/$node_id/_repositories_metering";
        }
        throw new RuntimeException('Missing parameter for the endpoint nodes.get_repositories_metering_info');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setNodeId($node_id): GetRepositoriesMeteringInfo
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