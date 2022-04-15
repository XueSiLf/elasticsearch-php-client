<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:08:45
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteCalendarJob
 * Elasticsearch API name ml.delete_calendar_job
 */
class DeleteCalendarJob extends AbstractEndpoint
{
    protected $calendar_id;
    protected $job_id;

    public function getURI(): string
    {
        $calendar_id = $this->calendar_id ?? null;
        $job_id = $this->job_id ?? null;

        if (isset($calendar_id) && isset($job_id)) {
            return "/_ml/calendars/$calendar_id/jobs/$job_id";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.delete_calendar_job');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setCalendarId($calendar_id): DeleteCalendarJob
    {
        if (isset($calendar_id) !== true) {
            return $this;
        }
        $this->calendar_id = $calendar_id;

        return $this;
    }

    public function setJobId($job_id): DeleteCalendarJob
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }
}
