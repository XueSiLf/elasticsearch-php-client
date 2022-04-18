<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:22:14
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Watcher;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeactivateWatch
 * Elasticsearch API name watcher.deactivate_watch
 */
class DeactivateWatch extends AbstractEndpoint
{
    protected $watch_id;

    public function getURI(): string
    {
        $watch_id = $this->watch_id ?? null;

        if (isset($watch_id)) {
            return "/_watcher/watch/$watch_id/_deactivate";
        }
        throw new RuntimeException('Missing parameter for the endpoint watcher.deactivate_watch');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setWatchId($watch_id): DeactivateWatch
    {
        if (isset($watch_id) !== true) {
            return $this;
        }
        $this->watch_id = $watch_id;

        return $this;
    }
}