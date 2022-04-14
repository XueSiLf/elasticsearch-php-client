<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:31:15
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Enrich;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stats
 * Elasticsearch API name enrich.stats
 */
class Stats extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_enrich/_stats";
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