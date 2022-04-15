<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:03:23
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Migration;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetFeatureUpgradeStatus
 * Elasticsearch API name migration.get_feature_upgrade_status
 */
class GetFeatureUpgradeStatus extends AbstractEndpoint
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
        return 'GET';
    }
}