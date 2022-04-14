<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:08:10
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class RemoteInfo
 * Elasticsearch API name cluster.remote_info
 */
class RemoteInfo extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_remote/info";
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}