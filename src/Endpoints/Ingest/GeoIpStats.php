<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:37:42
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ingest;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GeoIpStats
 * Elasticsearch API name ingest.geo_ip_stats
 */
class GeoIpStats extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ingest/geoip/stats";
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
