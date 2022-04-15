<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:51:18
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Split
 * Elasticsearch API name indices.split
 */
class Split extends AbstractEndpoint
{
    protected $target;

    public function getURI(): string
    {
        $index = $this->index ?? null;
        $target = $this->target ?? null;

        if (isset($index) && isset($target)) {
            return "/$index/_split/$target";
        }
        throw new RuntimeException('Missing parameter for the endpoint indices.split');
    }

    public function getParamWhitelist(): array
    {
        return [
            'copy_settings',
            'timeout',
            'master_timeout',
            'wait_for_active_shards'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): Split
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setTarget($target): Split
    {
        if (isset($target) !== true) {
            return $this;
        }
        $this->target = $target;

        return $this;
    }
}
