<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:57:41
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Autoscaling;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetAutoscalingPolicy
 * Elasticsearch API name autoscaling.get_autoscaling_policy
 */
class GetAutoscalingPolicy extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_autoscaling/policy/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint autoscaling.get_autoscaling_policy');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setName($name): GetAutoscalingPolicy
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}