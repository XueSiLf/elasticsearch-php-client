<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:26:20
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetDataFrameAnalytics
 * Elasticsearch API name ml.get_data_frame_analytics
 */
class GetDataFrameAnalytics extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_ml/data_frame/analytics/$id";
        }
        return "/_ml/data_frame/analytics";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'from',
            'size',
            'exclude_generated'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
