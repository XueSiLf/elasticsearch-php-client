<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:06:19
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class Reindex
 * Elasticsearch API name reindex
 */
class Reindex extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_reindex";
    }

    public function getParamWhitelist(): array
    {
        return [
            'refresh',
            'timeout',
            'wait_for_active_shards',
            'wait_for_completion',
            'requests_per_second',
            'scroll',
            'slices',
            'max_docs'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Reindex
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}