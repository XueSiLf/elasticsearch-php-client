<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:24:33
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Tasks;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Cancel
 * Elasticsearch API name tasks.cancel
 */
class Cancel extends AbstractEndpoint
{
    protected $task_id;

    public function getURI(): string
    {
        $task_id = $this->task_id ?? null;

        if (isset($task_id)) {
            return "/_tasks/$task_id/_cancel";
        }
        return "/_tasks/_cancel";
    }

    public function getParamWhitelist(): array
    {
        return [
            'nodes',
            'actions',
            'parent_task_id',
            'wait_for_completion'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setTaskId($task_id): Cancel
    {
        if (isset($task_id) !== true) {
            return $this;
        }
        $this->task_id = $task_id;

        return $this;
    }
}
