<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:28:15
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetJobStats
 * Elasticsearch API name ml.get_job_stats
 */
class GetJobStats extends AbstractEndpoint
{
    protected $job_id;

    public function getURI(): string
    {
        $job_id = $this->job_id ?? null;

        if (isset($job_id)) {
            return "/_ml/anomaly_detectors/$job_id/_stats";
        }
        return "/_ml/anomaly_detectors/_stats";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'allow_no_jobs'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setJobId($job_id): GetJobStats
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }
}