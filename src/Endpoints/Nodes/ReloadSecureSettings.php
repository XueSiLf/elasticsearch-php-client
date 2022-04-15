<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:14:49
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Nodes;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ReloadSecureSettings
 * Elasticsearch API name nodes.reload_secure_settings
 */
class ReloadSecureSettings extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_nodes/$node_id/reload_secure_settings";
        }
        return "/_nodes/reload_secure_settings";
    }

    public function getParamWhitelist(): array
    {
        return [
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): ReloadSecureSettings
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setNodeId($node_id): ReloadSecureSettings
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