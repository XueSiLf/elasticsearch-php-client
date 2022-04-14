<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:24:24
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\DataFrameTransformDeprecated;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class StartTransform
 * Elasticsearch API name data_frame_transform_deprecated.start_transform
 */
class StartTransform extends AbstractEndpoint
{
    protected $transform_id;

    public function getURI(): string
    {
        $transform_id = $this->transform_id ?? null;

        if (isset($transform_id)) {
            return "/_data_frame/transforms/$transform_id/_start";
        }
        throw new RuntimeException('Missing parameter for the endpoint data_frame_transform_deprecated.start_transform');
    }

    public function getParamWhitelist(): array
    {
        return [
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setTransformId($transform_id): StartTransform
    {
        if (isset($transform_id) !== true) {
            return $this;
        }
        $this->transform_id = $transform_id;

        return $this;
    }
}
