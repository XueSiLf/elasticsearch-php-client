<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:22:38
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\DataFrameTransformDeprecated;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetTransform
 * Elasticsearch API name data_frame_transform_deprecated.get_transform
 */
class GetTransform extends AbstractEndpoint
{
    protected $transform_id;

    public function getURI(): string
    {
        $transform_id = $this->transform_id ?? null;

        if (isset($transform_id)) {
            return "/_data_frame/transforms/$transform_id";
        }
        return "/_data_frame/transforms";
    }

    public function getParamWhitelist(): array
    {
        return [
            'from',
            'size',
            'allow_no_match',
            'exclude_generated'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setTransformId($transform_id): GetTransform
    {
        if (isset($transform_id) !== true) {
            return $this;
        }
        $this->transform_id = $transform_id;

        return $this;
    }
}