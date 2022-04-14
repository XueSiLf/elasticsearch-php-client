<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:57:59
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ccr;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stats
 * Elasticsearch API name ccr.stats
 */
class Stats extends AbstractEndpoint
{
    public function getURI(): string
    {

        return "/_ccr/stats";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}