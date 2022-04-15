<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:26:17
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Tasks;

/**
 * Class TasksNamespace
 */
class TasksNamespace extends AbstractNamespace
{
    /**
     * Cancels a task, if it can be cancelled through an API.
     *
     * $params['task_id']             = (string) Cancel the task with specified task id (node_id:task_number)
     * $params['nodes']               = (list) A comma-separated list of node IDs or names to limit the returned information; use `_local` to return information from the node you're connecting to, leave empty to get information from all nodes
     * $params['actions']             = (list) A comma-separated list of actions that should be cancelled. Leave empty to cancel all.
     * $params['parent_task_id']      = (string) Cancel tasks with specified parent task id (node_id:task_number). Set to -1 to cancel all.
     * $params['wait_for_completion'] = (boolean) Should the request block until the cancellation of the task and its descendant tasks is completed. Defaults to false
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/tasks.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function cancel(array $params = [])
    {
        $task_id = $this->extractArgument($params, 'task_id');

        $endpointBuilder = $this->endpoints;
        /** @var Tasks\Cancel $endpoint */
        $endpoint = $endpointBuilder('Tasks\Cancel');
        $endpoint->setParams($params);
        $endpoint->setTaskId($task_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about a task.
     *
     * $params['task_id']             = (string) Return the task with specified id (node_id:task_number)
     * $params['wait_for_completion'] = (boolean) Wait for the matching tasks to complete (default: false)
     * $params['timeout']             = (time) Explicit operation timeout
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/tasks.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function get(array $params = [])
    {
        $task_id = $this->extractArgument($params, 'task_id');

        $endpointBuilder = $this->endpoints;
        /** @var Tasks\Get $endpoint */
        $endpoint = $endpointBuilder('Tasks\Get');
        $endpoint->setParams($params);
        $endpoint->setTaskId($task_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns a list of tasks.
     *
     * $params['nodes']               = (list) A comma-separated list of node IDs or names to limit the returned information; use `_local` to return information from the node you're connecting to, leave empty to get information from all nodes
     * $params['actions']             = (list) A comma-separated list of actions that should be returned. Leave empty to return all.
     * $params['detailed']            = (boolean) Return detailed task information (default: false)
     * $params['parent_task_id']      = (string) Return tasks with specified parent task id (node_id:task_number). Set to -1 to return all.
     * $params['wait_for_completion'] = (boolean) Wait for the matching tasks to complete (default: false)
     * $params['group_by']            = (enum) Group tasks by nodes or parent/child relationships (Options = nodes,parents,none) (Default = nodes)
     * $params['timeout']             = (time) Explicit operation timeout
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/tasks.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function list(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Tasks\ListTasks $endpoint */
        $endpoint = $endpointBuilder('Tasks\ListTasks');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Proxy function to list() to prevent BC break since 7.4.0
     */
    public function tasksList(array $params = [])
    {
        return $this->list($params);
    }
}