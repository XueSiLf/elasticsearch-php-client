<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:11:09
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteForecast
 * Elasticsearch API name ml.delete_forecast
 */
class DeleteForecast extends AbstractEndpoint
{
    protected $job_id;
    protected $forecast_id;

    public function getURI(): string
    {
        if (isset($this->job_id) !== true) {
            throw new RuntimeException(
                'job_id is required for delete_forecast'
            );
        }
        $job_id = $this->job_id;
        $forecast_id = $this->forecast_id ?? null;

        if (isset($forecast_id)) {
            return "/_ml/anomaly_detectors/$job_id/_forecast/$forecast_id";
        }
        return "/_ml/anomaly_detectors/$job_id/_forecast";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_forecasts',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setJobId($job_id): DeleteForecast
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }

    public function setForecastId($forecast_id): DeleteForecast
    {
        if (isset($forecast_id) !== true) {
            return $this;
        }
        $this->forecast_id = $forecast_id;

        return $this;
    }
}