<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:56:09
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Autoscaling;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteAutoscalingPolicy
 * Elasticsearch API name autoscaling.delete_autoscaling_policy
 */
class DeleteAutoscalingPolicy extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_autoscaling/policy/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint autoscaling.delete_autoscaling_policy');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setName($name): DeleteAutoscalingPolicy
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}
