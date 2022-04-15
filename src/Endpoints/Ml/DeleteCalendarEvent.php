<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:08:10
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteCalendarEvent
 * Elasticsearch API name ml.delete_calendar_event
 */
class DeleteCalendarEvent extends AbstractEndpoint
{
    protected $calendar_id;
    protected $event_id;

    public function getURI(): string
    {
        $calendar_id = $this->calendar_id ?? null;
        $event_id = $this->event_id ?? null;

        if (isset($calendar_id) && isset($event_id)) {
            return "/_ml/calendars/$calendar_id/events/$event_id";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.delete_calendar_event');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setCalendarId($calendar_id): DeleteCalendarEvent
    {
        if (isset($calendar_id) !== true) {
            return $this;
        }
        $this->calendar_id = $calendar_id;

        return $this;
    }

    public function setEventId($event_id): DeleteCalendarEvent
    {
        if (isset($event_id) !== true) {
            return $this;
        }
        $this->event_id = $event_id;

        return $this;
    }
}