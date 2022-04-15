<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 14:21:38
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class SetUpgradeMode
 * Elasticsearch API name ml.set_upgrade_mode
 */
class SetUpgradeMode extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ml/set_upgrade_mode";
    }

    public function getParamWhitelist(): array
    {
        return [
            'enabled',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}