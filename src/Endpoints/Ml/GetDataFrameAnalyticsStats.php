<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:26:44
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetDataFrameAnalyticsStats
 * Elasticsearch API name ml.get_data_frame_analytics_stats
 */
class GetDataFrameAnalyticsStats extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_ml/data_frame/analytics/$id/_stats";
        }
        return "/_ml/data_frame/analytics/_stats";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'from',
            'size',
            'verbose'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}