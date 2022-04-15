<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:21:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\Elasticsearch\Endpoints\Ilm;

/**
 * Class IlmNamespace
 */
class IlmNamespace extends AbstractNamespace
{
    /**
     * Deletes the specified lifecycle policy definition. A currently used policy cannot be deleted.
     *
     * $params['policy'] = (string) The name of the index lifecycle policy
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-delete-lifecycle.html
     */
    public function deleteLifecycle(array $params = [])
    {
        $policy = $this->extractArgument($params, 'policy');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\DeleteLifecycle $endpoint */
        $endpoint = $endpointBuilder('Ilm\DeleteLifecycle');
        $endpoint->setParams($params);
        $endpoint->setPolicy($policy);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information about the index's current lifecycle state, such as the currently executing phase, action, and step.
     *
     * $params['index']        = (string) The name of the index to explain
     * $params['only_managed'] = (boolean) filters the indices included in the response to ones managed by ILM
     * $params['only_errors']  = (boolean) filters the indices included in the response to ones in an ILM error state, implies only_managed
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-explain-lifecycle.html
     */
    public function explainLifecycle(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\ExplainLifecycle $endpoint */
        $endpoint = $endpointBuilder('Ilm\ExplainLifecycle');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the specified policy definition. Includes the policy version and last modified date.
     *
     * $params['policy'] = (string) The name of the index lifecycle policy
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-get-lifecycle.html
     */
    public function getLifecycle(array $params = [])
    {
        $policy = $this->extractArgument($params, 'policy');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\GetLifecycle $endpoint */
        $endpoint = $endpointBuilder('Ilm\GetLifecycle');
        $endpoint->setParams($params);
        $endpoint->setPolicy($policy);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves the current index lifecycle management (ILM) status.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-get-status.html
     */
    public function getStatus(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ilm\GetStatus $endpoint */
        $endpoint = $endpointBuilder('Ilm\GetStatus');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Migrates the indices and ILM policies away from custom node attribute allocation routing to data tiers routing
     *
     * $params['dry_run'] = (boolean) If set to true it will simulate the migration, providing a way to retrieve the ILM policies and indices that need to be migrated. The default is false
     * $params['body']    = (array) Optionally specify a legacy index template name to delete and optionally specify a node attribute name used for index shard routing (defaults to "data")
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-migrate-to-data-tiers.html
     */
    public function migrateToDataTiers(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\MigrateToDataTiers $endpoint */
        $endpoint = $endpointBuilder('Ilm\MigrateToDataTiers');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Manually moves an index into the specified step and executes that step.
     *
     * $params['index'] = (string) The name of the index whose lifecycle step is to change
     * $params['body']  = (array) The new lifecycle step to move to
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-move-to-step.html
     */
    public function moveToStep(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\MoveToStep $endpoint */
        $endpoint = $endpointBuilder('Ilm\MoveToStep');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a lifecycle policy
     *
     * $params['policy'] = (string) The name of the index lifecycle policy
     * $params['body']   = (array) The lifecycle policy definition to register
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-put-lifecycle.html
     */
    public function putLifecycle(array $params = [])
    {
        $policy = $this->extractArgument($params, 'policy');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\PutLifecycle $endpoint */
        $endpoint = $endpointBuilder('Ilm\PutLifecycle');
        $endpoint->setParams($params);
        $endpoint->setPolicy($policy);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Removes the assigned lifecycle policy and stops managing the specified index
     *
     * $params['index'] = (string) The name of the index to remove policy on
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-remove-policy.html
     */
    public function removePolicy(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\RemovePolicy $endpoint */
        $endpoint = $endpointBuilder('Ilm\RemovePolicy');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Retries executing the policy for an index that is in the ERROR step.
     *
     * $params['index'] = (string) The name of the indices (comma-separated) whose failed lifecycle step is to be retry
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-retry-policy.html
     */
    public function retry(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Ilm\Retry $endpoint */
        $endpoint = $endpointBuilder('Ilm\Retry');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Start the index lifecycle management (ILM) plugin.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-start.html
     */
    public function start(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ilm\Start $endpoint */
        $endpoint = $endpointBuilder('Ilm\Start');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Halts all lifecycle management operations and stops the index lifecycle management (ILM) plugin
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ilm-stop.html
     */
    public function stop(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ilm\Stop $endpoint */
        $endpoint = $endpointBuilder('Ilm\Stop');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}