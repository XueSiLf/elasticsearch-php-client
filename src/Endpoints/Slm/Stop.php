<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:04:45
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Slm;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stop
 * Elasticsearch API name slm.stop
 */
class Stop extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_slm/stop";
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
