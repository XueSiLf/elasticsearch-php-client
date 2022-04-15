<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:18:14
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class FlushJob
 * Elasticsearch API name ml.flush_job
 */
class FlushJob extends AbstractEndpoint
{
    protected $job_id;

    public function getURI(): string
    {
        $job_id = $this->job_id ?? null;

        if (isset($job_id)) {
            return "/_ml/anomaly_detectors/$job_id/_flush";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.flush_job');
    }

    public function getParamWhitelist(): array
    {
        return [
            'calc_interim',
            'start',
            'end',
            'advance_time',
            'skip_time'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): FlushJob
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setJobId($job_id): FlushJob
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }
}