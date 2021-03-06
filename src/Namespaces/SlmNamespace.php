<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:27:18
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Slm;

/**
 * Class SlmNamespace
 */
class SlmNamespace extends AbstractNamespace
{
    /**
     * Deletes an existing snapshot lifecycle policy.
     *
     * $params['policy_id'] = (string) The id of the snapshot lifecycle policy to remove
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-delete-policy.html
     */
    public function deleteLifecycle(array $params = [])
    {
        $policy_id = $this->extractArgument($params, 'policy_id');

        $endpointBuilder = $this->endpoints;
        /** @var Slm\DeleteLifecycle $endpoint */
        $endpoint = $endpointBuilder('Slm\DeleteLifecycle');
        $endpoint->setParams($params);
        $endpoint->setPolicyId($policy_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Immediately creates a snapshot according to the lifecycle policy, without waiting for the scheduled time.
     *
     * $params['policy_id'] = (string) The id of the snapshot lifecycle policy to be executed
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-execute-lifecycle.html
     */
    public function executeLifecycle(array $params = [])
    {
        $policy_id = $this->extractArgument($params, 'policy_id');

        $endpointBuilder = $this->endpoints;
        /** @var Slm\ExecuteLifecycle $endpoint */
        $endpoint = $endpointBuilder('Slm\ExecuteLifecycle');
        $endpoint->setParams($params);
        $endpoint->setPolicyId($policy_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes any snapshots that are expired according to the policy's retention rules.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-execute-retention.html
     */
    public function executeRetention(array $params = [])
    {

        $endpointBuilder = $this->endpoints;
        /** @var Slm\ExecuteRetention $endpoint */
        $endpoint = $endpointBuilder('Slm\ExecuteRetention');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves one or more snapshot lifecycle policy definitions and information about the latest snapshot attempts.
     *
     * $params['policy_id'] = (list) Comma-separated list of snapshot lifecycle policies to retrieve
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-get-policy.html
     */
    public function getLifecycle(array $params = [])
    {
        $policy_id = $this->extractArgument($params, 'policy_id');

        $endpointBuilder = $this->endpoints;
        /** @var Slm\GetLifecycle $endpoint */
        $endpoint = $endpointBuilder('Slm\GetLifecycle');
        $endpoint->setParams($params);
        $endpoint->setPolicyId($policy_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns global and policy-level statistics about actions taken by snapshot lifecycle management.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/slm-api-get-stats.html
     */
    public function getStats(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Slm\GetStats $endpoint */
        $endpoint = $endpointBuilder('Slm\GetStats');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves the status of snapshot lifecycle management (SLM).
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-get-status.html
     */
    public function getStatus(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Slm\GetStatus $endpoint */
        $endpoint = $endpointBuilder('Slm\GetStatus');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates or updates a snapshot lifecycle policy.
     *
     * $params['policy_id'] = (string) The id of the snapshot lifecycle policy
     * $params['body']      = (array) The snapshot lifecycle policy definition to register
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-put-policy.html
     */
    public function putLifecycle(array $params = [])
    {
        $policy_id = $this->extractArgument($params, 'policy_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Slm\PutLifecycle $endpoint */
        $endpoint = $endpointBuilder('Slm\PutLifecycle');
        $endpoint->setParams($params);
        $endpoint->setPolicyId($policy_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Turns on snapshot lifecycle management (SLM).
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-start.html
     */
    public function start(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Slm\Start $endpoint */
        $endpoint = $endpointBuilder('Slm\Start');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Turns off snapshot lifecycle management (SLM).
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/slm-api-stop.html
     */
    public function stop(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Slm\Stop $endpoint */
        $endpoint = $endpointBuilder('Slm\Stop');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}
