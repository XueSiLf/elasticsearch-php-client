<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:24:29
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Watcher;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class QueryWatches
 * Elasticsearch API name watcher.query_watches
 */
class QueryWatches extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_watcher/_query/watches";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): QueryWatches
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
