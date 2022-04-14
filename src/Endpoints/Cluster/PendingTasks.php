<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:06:22
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PendingTasks
 * Elasticsearch API name cluster.pending_tasks
 */
class PendingTasks extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cluster/pending_tasks";
    }

    public function getParamWhitelist(): array
    {
        return [
            'local',
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}