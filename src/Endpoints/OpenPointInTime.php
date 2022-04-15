<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:04:55
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class OpenPointInTime
 * Elasticsearch API name open_point_in_time
 */
class OpenPointInTime extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_pit";
        }
        throw new RuntimeException('Missing parameter for the endpoint open_point_in_time');
    }

    public function getParamWhitelist(): array
    {
        return [
            'preference',
            'routing',
            'ignore_unavailable',
            'expand_wildcards',
            'keep_alive'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}
