<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:27:05
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetFilters
 * Elasticsearch API name ml.get_filters
 */
class GetFilters extends AbstractEndpoint
{
    protected $filter_id;

    public function getURI(): string
    {
        $filter_id = $this->filter_id ?? null;

        if (isset($filter_id)) {
            return "/_ml/filters/$filter_id";
        }
        return "/_ml/filters";
    }

    public function getParamWhitelist(): array
    {
        return [
            'from',
            'size'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setFilterId($filter_id): GetFilters
    {
        if (isset($filter_id) !== true) {
            return $this;
        }
        $this->filter_id = $filter_id;

        return $this;
    }
}