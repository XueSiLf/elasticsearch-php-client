<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:36:07
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Recovery
 * Elasticsearch API name cat.recovery
 */
class Recovery extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/_cat/recovery/$index";
        }
        return "/_cat/recovery";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'active_only',
            'bytes',
            'detailed',
            'h',
            'help',
            'index',
            's',
            'time',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}