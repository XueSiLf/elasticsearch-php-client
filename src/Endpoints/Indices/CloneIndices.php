<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:28:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class CloneIndices
 * Elasticsearch API name indices.clone
 */
class CloneIndices extends AbstractEndpoint
{
    protected $target;

    public function getURI(): string
    {
        $index = $this->index ?? null;
        $target = $this->target ?? null;

        if (isset($index) && isset($target)) {
            return "/$index/_clone/$target";
        }
        throw new RuntimeException('Missing parameter for the endpoint indices.clone');
    }

    public function getParamWhitelist(): array
    {
        return [
            'timeout',
            'master_timeout',
            'wait_for_active_shards'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): CloneIndices
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setTarget($target): CloneIndices
    {
        if (isset($target) !== true) {
            return $this;
        }
        $this->target = $target;

        return $this;
    }
}
