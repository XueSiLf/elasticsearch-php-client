<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:09:21
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteDatafeed
 * Elasticsearch API name ml.delete_datafeed
 */
class DeleteDatafeed extends AbstractEndpoint
{
    protected $datafeed_id;

    public function getURI(): string
    {
        $datafeed_id = $this->datafeed_id ?? null;

        if (isset($datafeed_id)) {
            return "/_ml/datafeeds/$datafeed_id";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.delete_datafeed');
    }

    public function getParamWhitelist(): array
    {
        return [
            'force'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setDatafeedId($datafeed_id): DeleteDatafeed
    {
        if (isset($datafeed_id) !== true) {
            return $this;
        }
        $this->datafeed_id = $datafeed_id;

        return $this;
    }
}