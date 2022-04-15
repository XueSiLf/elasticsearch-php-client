<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:26:47
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class StopDataFrameAnalytics
 * Elasticsearch API name ml.stop_data_frame_analytics
 */
class StopDataFrameAnalytics extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_ml/data_frame/analytics/$id/_stop";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.stop_data_frame_analytics');
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'force',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): StopDataFrameAnalytics
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}