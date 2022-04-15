<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:25:06
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Tasks;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Get
 * Elasticsearch API name tasks.get
 */
class Get extends AbstractEndpoint
{
    protected $task_id;

    public function getURI(): string
    {
        $task_id = $this->task_id ?? null;

        if (isset($task_id)) {
            return "/_tasks/$task_id";
        }
        throw new RuntimeException('Missing parameter for the endpoint tasks.get');
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_completion',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setTaskId($task_id): Get
    {
        if (isset($task_id) !== true) {
            return $this;
        }
        $this->task_id = $task_id;

        return $this;
    }
}
