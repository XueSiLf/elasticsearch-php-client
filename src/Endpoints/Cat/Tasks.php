<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:40:02
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Tasks
 * Elasticsearch API name cat.tasks
 */
class Tasks extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cat/tasks";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'nodes',
            'actions',
            'detailed',
            'parent_task_id',
            'h',
            'help',
            's',
            'time',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
