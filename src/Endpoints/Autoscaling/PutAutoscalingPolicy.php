<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:58:19
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Autoscaling;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PutAutoscalingPolicy
 * Elasticsearch API name autoscaling.put_autoscaling_policy
 */
class PutAutoscalingPolicy extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_autoscaling/policy/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint autoscaling.put_autoscaling_policy');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): PutAutoscalingPolicy
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setName($name): PutAutoscalingPolicy
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}
