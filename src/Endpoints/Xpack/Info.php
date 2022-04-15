<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:32:13
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Xpack;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Info
 * Elasticsearch API name xpack.info
 */
class Info extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_xpack";
    }

    public function getParamWhitelist(): array
    {
        return [
            'categories',
            'accept_enterprise'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}