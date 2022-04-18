<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:17:31
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Transform;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class StopTransform
 * Elasticsearch API name transform.stop_transform
 */
class StopTransform extends AbstractEndpoint
{
    protected $transform_id;

    public function getURI(): string
    {
        $transform_id = $this->transform_id ?? null;

        if (isset($transform_id)) {
            return "/_transform/$transform_id/_stop";
        }
        throw new RuntimeException('Missing parameter for the endpoint transform.stop_transform');
    }

    public function getParamWhitelist(): array
    {
        return [
            'force',
            'wait_for_completion',
            'timeout',
            'allow_no_match',
            'wait_for_checkpoint'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setTransformId($transform_id): StopTransform
    {
        if (isset($transform_id) !== true) {
            return $this;
        }
        $this->transform_id = $transform_id;

        return $this;
    }
}