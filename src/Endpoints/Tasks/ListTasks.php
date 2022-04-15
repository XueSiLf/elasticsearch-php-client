<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:25:31
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Tasks;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ListTasks
 * Elasticsearch API name tasks.list
 */
class ListTasks extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_tasks";
    }

    public function getParamWhitelist(): array
    {
        return [
            'nodes',
            'actions',
            'detailed',
            'parent_task_id',
            'wait_for_completion',
            'group_by',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}