<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:35:36
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Eql;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Search
 * Elasticsearch API name eql.search
 */
class Search extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_eql/search";
        }
        throw new RuntimeException('Missing parameter for the endpoint eql.search');
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_completion_timeout',
            'keep_on_completion',
            'keep_alive'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): Search
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
