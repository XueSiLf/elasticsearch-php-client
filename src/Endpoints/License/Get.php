<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:42:22
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\License;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Get
 * Elasticsearch API name license.get
 */
class Get extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_license";
    }

    public function getParamWhitelist(): array
    {
        return [
            'local',
            'accept_enterprise'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}