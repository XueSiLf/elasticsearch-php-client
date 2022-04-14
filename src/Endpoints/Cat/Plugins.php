<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:35:46
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Plugins
 * Elasticsearch API name cat.plugins
 */
class Plugins extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cat/plugins";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'local',
            'master_timeout',
            'h',
            'help',
            'include_bootstrap',
            's',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}