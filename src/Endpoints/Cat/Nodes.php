<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:34:45
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Nodes
 * Elasticsearch API name cat.nodes
 */
class Nodes extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cat/nodes";
    }

    public function getParamWhitelist(): array
    {
        return [
            'bytes',
            'format',
            'full_id',
            'local',
            'master_timeout',
            'h',
            'help',
            's',
            'time',
            'v',
            'include_unloaded_segments'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}