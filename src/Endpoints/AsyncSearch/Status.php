<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:49:44
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\AsyncSearch;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;
use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class Status
 * Elasticsearch API name async_search.status
 */
class Status extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_async_search/status/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint async_search.status');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
