<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:38:23
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Features;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ResetFeatures
 * Elasticsearch API name features.reset_features
 */
class ResetFeatures extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_features/_reset";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}
