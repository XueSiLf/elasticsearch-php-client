<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:29:02
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Health
 * Elasticsearch API name cat.health
 */
class Health extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cat/health";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'h',
            'help',
            's',
            'time',
            'ts',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}