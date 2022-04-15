<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:25:55
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetDatafeedStats
 * Elasticsearch API name ml.get_datafeed_stats
 */
class GetDatafeedStats extends AbstractEndpoint
{
    protected $datafeed_id;

    public function getURI(): string
    {
        $datafeed_id = $this->datafeed_id ?? null;

        if (isset($datafeed_id)) {
            return "/_ml/datafeeds/$datafeed_id/_stats";
        }
        return "/_ml/datafeeds/_stats";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'allow_no_datafeeds'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setDatafeedId($datafeed_id): GetDatafeedStats
    {
        if (isset($datafeed_id) !== true) {
            return $this;
        }
        $this->datafeed_id = $datafeed_id;

        return $this;
    }
}
