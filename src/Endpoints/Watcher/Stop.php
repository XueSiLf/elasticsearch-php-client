<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:25:41
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Watcher;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stop
 * Elasticsearch API name watcher.stop
 */
class Stop extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_watcher/_stop";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}
