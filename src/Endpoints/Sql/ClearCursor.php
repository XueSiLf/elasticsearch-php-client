<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:26:39
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Sql;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearCursor
 * Elasticsearch API name sql.clear_cursor
 */
class ClearCursor extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_sql/close";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): ClearCursor
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}