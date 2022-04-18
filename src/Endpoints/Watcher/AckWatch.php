<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:21:17
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Watcher;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class AckWatch
 * Elasticsearch API name watcher.ack_watch
 */
class AckWatch extends AbstractEndpoint
{
    protected $watch_id;
    protected $action_id;

    public function getURI(): string
    {
        if (isset($this->watch_id) !== true) {
            throw new RuntimeException(
                'watch_id is required for ack_watch'
            );
        }
        $watch_id = $this->watch_id;
        $action_id = $this->action_id ?? null;

        if (isset($action_id)) {
            return "/_watcher/watch/$watch_id/_ack/$action_id";
        }
        return "/_watcher/watch/$watch_id/_ack";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setWatchId($watch_id): AckWatch
    {
        if (isset($watch_id) !== true) {
            return $this;
        }
        $this->watch_id = $watch_id;

        return $this;
    }

    public function setActionId($action_id): AckWatch
    {
        if (isset($action_id) !== true) {
            return $this;
        }
        if (is_array($action_id) === true) {
            $action_id = implode(",", $action_id);
        }
        $this->action_id = $action_id;

        return $this;
    }
}
