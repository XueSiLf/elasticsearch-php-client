<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:27:46
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Sql;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteAsync
 * Elasticsearch API name sql.delete_async
 */
class DeleteAsync extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_sql/async/delete/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint sql.delete_async');
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