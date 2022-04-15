<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:20:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetCalendars
 * Elasticsearch API name ml.get_calendars
 */
class GetCalendars extends AbstractEndpoint
{
    protected $calendar_id;

    public function getURI(): string
    {
        $calendar_id = $this->calendar_id ?? null;

        if (isset($calendar_id)) {
            return "/_ml/calendars/$calendar_id";
        }
        return "/_ml/calendars";
    }

    public function getParamWhitelist(): array
    {
        return [
            'from',
            'size'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): GetCalendars
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setCalendarId($calendar_id): GetCalendars
    {
        if (isset($calendar_id) !== true) {
            return $this;
        }
        $this->calendar_id = $calendar_id;

        return $this;
    }
}