<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:25:07
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetDatafeeds
 * Elasticsearch API name ml.get_datafeeds
 */
class GetDatafeeds extends AbstractEndpoint
{
    protected $datafeed_id;

    public function getURI(): string
    {
        $datafeed_id = $this->datafeed_id ?? null;

        if (isset($datafeed_id)) {
            return "/_ml/datafeeds/$datafeed_id";
        }
        return "/_ml/datafeeds";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'allow_no_datafeeds',
            'exclude_generated'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setDatafeedId($datafeed_id): GetDatafeeds
    {
        if (isset($datafeed_id) !== true) {
            return $this;
        }
        $this->datafeed_id = $datafeed_id;

        return $this;
    }
}
