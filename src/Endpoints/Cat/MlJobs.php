<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:33:17
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class MlJobs
 * Elasticsearch API name cat.ml_jobs
 */
class MlJobs extends AbstractEndpoint
{
    protected $job_id;

    public function getURI(): string
    {
        $job_id = $this->job_id ?? null;

        if (isset($job_id)) {
            return "/_cat/ml/anomaly_detectors/$job_id";
        }
        return "/_cat/ml/anomaly_detectors";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'allow_no_jobs',
            'bytes',
            'format',
            'h',
            'help',
            's',
            'time',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setJobId($job_id): MlJobs
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }
}