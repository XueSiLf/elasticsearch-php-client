<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:28:17
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Sql;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetAsync
 * Elasticsearch API name sql.get_async
 */
class GetAsync extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_sql/async/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint sql.get_async');
    }

    public function getParamWhitelist(): array
    {
        return [
            'delimiter',
            'format',
            'keep_alive',
            'wait_for_completion_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}