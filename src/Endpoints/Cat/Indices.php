<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:30:14
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Indices
 * Elasticsearch API name cat.indices
 */
class Indices extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/_cat/indices/$index";
        }
        return "/_cat/indices";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'bytes',
            'local',
            'master_timeout',
            'h',
            'health',
            'help',
            'pri',
            's',
            'time',
            'v',
            'include_unloaded_segments',
            'expand_wildcards'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}