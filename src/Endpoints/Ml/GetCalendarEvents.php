<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:19:45
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetCalendarEvents
 * Elasticsearch API name ml.get_calendar_events
 */
class GetCalendarEvents extends AbstractEndpoint
{
    protected $calendar_id;

    public function getURI(): string
    {
        $calendar_id = $this->calendar_id ?? null;

        if (isset($calendar_id)) {
            return "/_ml/calendars/$calendar_id/events";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.get_calendar_events');
    }

    public function getParamWhitelist(): array
    {
        return [
            'job_id',
            'start',
            'end',
            'from',
            'size'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setCalendarId($calendar_id): GetCalendarEvents
    {
        if (isset($calendar_id) !== true) {
            return $this;
        }
        $this->calendar_id = $calendar_id;

        return $this;
    }
}