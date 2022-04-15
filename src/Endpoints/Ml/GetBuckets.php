<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:19:04
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetBuckets
 * Elasticsearch API name ml.get_buckets
 */
class GetBuckets extends AbstractEndpoint
{
    protected $job_id;
    protected $timestamp;

    public function getURI(): string
    {
        if (isset($this->job_id) !== true) {
            throw new RuntimeException(
                'job_id is required for get_buckets'
            );
        }
        $job_id = $this->job_id;
        $timestamp = $this->timestamp ?? null;

        if (isset($timestamp)) {
            return "/_ml/anomaly_detectors/$job_id/results/buckets/$timestamp";
        }
        return "/_ml/anomaly_detectors/$job_id/results/buckets";
    }

    public function getParamWhitelist(): array
    {
        return [
            'expand',
            'exclude_interim',
            'from',
            'size',
            'start',
            'end',
            'anomaly_score',
            'sort',
            'desc'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): GetBuckets
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setJobId($job_id): GetBuckets
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }

    public function setTimestamp($timestamp): GetBuckets
    {
        if (isset($timestamp) !== true) {
            return $this;
        }
        $this->timestamp = $timestamp;

        return $this;
    }
}