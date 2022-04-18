<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:24:53
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Watcher;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Start
 * Elasticsearch API name watcher.start
 */
class Start extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_watcher/_start";
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