<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:29:43
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Sql;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Translate
 * Elasticsearch API name sql.translate
 */
class Translate extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_sql/translate";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): Translate
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}