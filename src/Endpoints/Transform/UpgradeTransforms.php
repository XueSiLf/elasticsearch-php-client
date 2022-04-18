<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:18:19
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Transform;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class UpgradeTransforms
 * Elasticsearch API name transform.upgrade_transforms
 */
class UpgradeTransforms extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_transform/_upgrade";
    }

    public function getParamWhitelist(): array
    {
        return [
            'dry_run',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}