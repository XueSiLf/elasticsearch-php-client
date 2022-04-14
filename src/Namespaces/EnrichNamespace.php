<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:31:56
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\Elasticsearch\Endpoints\Enrich;

/**
 * Class EnrichNamespace
 */
class EnrichNamespace extends AbstractNamespace
{
    /**
     * Deletes an existing enrich policy and its enrich index.
     *
     * $params['name'] = (string) The name of the enrich policy
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/delete-enrich-policy-api.html
     */
    public function deletePolicy(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Enrich\DeletePolicy $endpoint */
        $endpoint = $endpointBuilder('Enrich\DeletePolicy');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates the enrich index for an existing enrich policy.
     *
     * $params['name']                = (string) The name of the enrich policy
     * $params['wait_for_completion'] = (boolean) Should the request should block until the execution is complete. (Default = true)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/execute-enrich-policy-api.html
     */
    public function executePolicy(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Enrich\ExecutePolicy $endpoint */
        $endpoint = $endpointBuilder('Enrich\ExecutePolicy');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets information about an enrich policy.
     *
     * $params['name'] = (list) A comma-separated list of enrich policy names
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-enrich-policy-api.html
     */
    public function getPolicy(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Enrich\GetPolicy $endpoint */
        $endpoint = $endpointBuilder('Enrich\GetPolicy');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a new enrich policy.
     *
     * $params['name'] = (string) The name of the enrich policy
     * $params['body'] = (array) The enrich policy to register (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/put-enrich-policy-api.html
     */
    public function putPolicy(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Enrich\PutPolicy $endpoint */
        $endpoint = $endpointBuilder('Enrich\PutPolicy');
        $endpoint->setParams($params);
        $endpoint->setName($name);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets enrich coordinator statistics and information about enrich policies that are currently executing.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/enrich-stats-api.html
     */
    public function stats(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Enrich\Stats $endpoint */
        $endpoint = $endpointBuilder('Enrich\Stats');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}
