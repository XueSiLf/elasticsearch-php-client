<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:31:51
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class MlDataFrameAnalytics
 * Elasticsearch API name cat.ml_data_frame_analytics
 */
class MlDataFrameAnalytics extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_cat/ml/data_frame/analytics/$id";
        }
        return "/_cat/ml/data_frame/analytics";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'bytes',
            'format',
            'h',
            'help',
            's',
            'time',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}