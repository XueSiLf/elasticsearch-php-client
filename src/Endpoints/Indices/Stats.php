<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:51:54
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stats
 * Elasticsearch API name indices.stats
 */
class Stats extends AbstractEndpoint
{
    protected $metric;

    public function getURI(): string
    {
        $metric = $this->metric ?? null;
        $index = $this->index ?? null;

        if (isset($index) && isset($metric)) {
            return "/$index/_stats/$metric";
        }
        if (isset($metric)) {
            return "/_stats/$metric";
        }
        if (isset($index)) {
            return "/$index/_stats";
        }
        return "/_stats";
    }

    public function getParamWhitelist(): array
    {
        return [
            'completion_fields',
            'fielddata_fields',
            'fields',
            'groups',
            'level',
            'types',
            'include_segment_file_sizes',
            'include_unloaded_segments',
            'expand_wildcards',
            'forbid_closed_indices'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setMetric($metric): Stats
    {
        if (isset($metric) !== true) {
            return $this;
        }
        if (is_array($metric) === true) {
            $metric = implode(",", $metric);
        }
        $this->metric = $metric;

        return $this;
    }
}