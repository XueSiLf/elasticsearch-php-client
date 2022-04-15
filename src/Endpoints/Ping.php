<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:05:15
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class Ping
 * Elasticsearch API name ping
 */
class Ping extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'HEAD';
    }
}