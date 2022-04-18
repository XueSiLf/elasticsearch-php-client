<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:23:21
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Watcher;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ExecuteWatch
 * Elasticsearch API name watcher.execute_watch
 */
class ExecuteWatch extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_watcher/watch/$id/_execute";
        }
        return "/_watcher/watch/_execute";
    }

    public function getParamWhitelist(): array
    {
        return [
            'debug'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): ExecuteWatch
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
