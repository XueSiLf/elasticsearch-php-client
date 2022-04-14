<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:26:37
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\AsyncSearch;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Delete
 * Elasticsearch API name async_search.delete
 */
class Delete extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_async_search/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint async_search.delete');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }
}
