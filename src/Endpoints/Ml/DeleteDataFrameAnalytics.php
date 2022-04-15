<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:09:46
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteDataFrameAnalytics
 * Elasticsearch API name ml.delete_data_frame_analytics
 */
class DeleteDataFrameAnalytics extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_ml/data_frame/analytics/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.delete_data_frame_analytics');
    }

    public function getParamWhitelist(): array
    {
        return [
            'force',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }
}