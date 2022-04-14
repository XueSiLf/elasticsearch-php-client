<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:42:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Fleet;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Search
 * Elasticsearch API name fleet.search
 */
class Search extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_fleet/_fleet_search";
        }
        throw new RuntimeException('Missing parameter for the endpoint fleet.search');
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_checkpoints',
            'wait_for_checkpoints_timeout',
            'allow_partial_search_results'
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
