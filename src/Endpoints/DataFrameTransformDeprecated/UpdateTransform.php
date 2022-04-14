<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:25:24
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\DataFrameTransformDeprecated;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class UpdateTransform
 * Elasticsearch API name data_frame_transform_deprecated.update_transform
 */
class UpdateTransform extends AbstractEndpoint
{
    protected $transform_id;

    public function getURI(): string
    {
        $transform_id = $this->transform_id ?? null;

        if (isset($transform_id)) {
            return "/_data_frame/transforms/$transform_id/_update";
        }
        throw new RuntimeException('Missing parameter for the endpoint data_frame_transform_deprecated.update_transform');
    }

    public function getParamWhitelist(): array
    {
        return [
            'defer_validation'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): UpdateTransform
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setTransformId($transform_id): UpdateTransform
    {
        if (isset($transform_id) !== true) {
            return $this;
        }
        $this->transform_id = $transform_id;

        return $this;
    }
}