<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:33:46
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Eql;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Delete
 * Elasticsearch API name eql.delete
 */
class Delete extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_eql/search/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint eql.delete');
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