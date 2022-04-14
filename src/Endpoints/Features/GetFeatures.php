<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:37:44
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Features;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetFeatures
 * Elasticsearch API name features.get_features
 */
class GetFeatures extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_features";
    }

    public function getParamWhitelist(): array
    {
        return [
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}