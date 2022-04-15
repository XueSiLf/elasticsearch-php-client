<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:03:48
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Migration;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PostFeatureUpgrade
 * Elasticsearch API name migration.post_feature_upgrade
 */
class PostFeatureUpgrade extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_migration/system_features";
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