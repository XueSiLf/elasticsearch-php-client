<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:57:10
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Autoscaling;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetAutoscalingCapacity
 * Elasticsearch API name autoscaling.get_autoscaling_capacity
 */
class GetAutoscalingCapacity extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_autoscaling/capacity";
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