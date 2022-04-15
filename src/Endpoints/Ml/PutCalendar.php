<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:44:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PutCalendar
 * Elasticsearch API name ml.put_calendar
 */
class PutCalendar extends AbstractEndpoint
{
    protected $calendar_id;

    public function getURI(): string
    {
        $calendar_id = $this->calendar_id ?? null;

        if (isset($calendar_id)) {
            return "/_ml/calendars/$calendar_id";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.put_calendar');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): PutCalendar
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setCalendarId($calendar_id): PutCalendar
    {
        if (isset($calendar_id) !== true) {
            return $this;
        }
        $this->calendar_id = $calendar_id;

        return $this;
    }
}
