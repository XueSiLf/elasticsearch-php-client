<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:29:19
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Sql;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Query
 * Elasticsearch API name sql.query
 */
class Query extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_sql";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): Query
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
