<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:02:49
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Migration;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Deprecations
 * Elasticsearch API name migration.deprecations
 */
class Deprecations extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_migration/deprecations";
        }
        return "/_migration/deprecations";
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}