<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:24:18
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetCategories
 * Elasticsearch API name ml.get_categories
 */
class GetCategories extends AbstractEndpoint
{
    protected $job_id;
    protected $category_id;

    public function getURI(): string
    {
        if (isset($this->job_id) !== true) {
            throw new RuntimeException(
                'job_id is required for get_categories'
            );
        }
        $job_id = $this->job_id;
        $category_id = $this->category_id ?? null;

        if (isset($category_id)) {
            return "/_ml/anomaly_detectors/$job_id/results/categories/$category_id";
        }
        return "/_ml/anomaly_detectors/$job_id/results/categories/";
    }

    public function getParamWhitelist(): array
    {
        return [
            'from',
            'size',
            'partition_field_value'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): GetCategories
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setJobId($job_id): GetCategories
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }

    public function setCategoryId($category_id): GetCategories
    {
        if (isset($category_id) !== true) {
            return $this;
        }
        $this->category_id = $category_id;

        return $this;
    }
}