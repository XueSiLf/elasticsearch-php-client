<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:28:46
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Sql;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetAsyncStatus
 * Elasticsearch API name sql.get_async_status
 */
class GetAsyncStatus extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_sql/async/status/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint sql.get_async_status');
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
