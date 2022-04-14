<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:23:27
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\DataFrameTransformDeprecated;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PreviewTransform
 * Elasticsearch API name data_frame_transform_deprecated.preview_transform
 */
class PreviewTransform extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_data_frame/transforms/_preview";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): PreviewTransform
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
