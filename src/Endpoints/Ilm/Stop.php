<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:20:39
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ilm;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stop
 * Elasticsearch API name ilm.stop
 */
class Stop extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ilm/stop";
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