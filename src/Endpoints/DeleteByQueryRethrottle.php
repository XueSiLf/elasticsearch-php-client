<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:53:41
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class DeleteByQueryRethrottle
 * Elasticsearch API name delete_by_query_rethrottle
 */
class DeleteByQueryRethrottle extends AbstractEndpoint
{
    protected $task_id;

    public function getURI(): string
    {
        $task_id = $this->task_id ?? null;

        if (isset($task_id)) {
            return "/_delete_by_query/$task_id/_rethrottle";
        }
        throw new RuntimeException('Missing parameter for the endpoint delete_by_query_rethrottle');
    }

    public function getParamWhitelist(): array
    {
        return [
            'requests_per_second'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setTaskId($task_id): DeleteByQueryRethrottle
    {
        if (isset($task_id) !== true) {
            return $this;
        }
        $this->task_id = $task_id;

        return $this;
    }
}