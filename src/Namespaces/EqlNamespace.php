<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:36:10
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Eql;

/**
 * Class EqlNamespace
 */
class EqlNamespace extends AbstractNamespace
{
    /**
     * Deletes an async EQL search by ID. If the search is still running, the search request will be cancelled. Otherwise, the saved search results are deleted.
     *
     * $params['id'] = (string) The async search ID
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/eql-search-api.html
     */
    public function delete(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Eql\Delete $endpoint */
        $endpoint = $endpointBuilder('Eql\Delete');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns async results from previously executed Event Query Language (EQL) search
     *
     * $params['id']                          = (string) The async search ID
     * $params['wait_for_completion_timeout'] = (time) Specify the time that the request should block waiting for the final response
     * $params['keep_alive']                  = (time) Update the time interval in which the results (partial or final) for this search will be available (Default = 5d)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/eql-search-api.html
     */
    public function get(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Eql\Get $endpoint */
        $endpoint = $endpointBuilder('Eql\Get');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the status of a previously submitted async or stored Event Query Language (EQL) search
     *
     * $params['id'] = (string) The async search ID
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/eql-search-api.html
     */
    public function getStatus(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Eql\GetStatus $endpoint */
        $endpoint = $endpointBuilder('Eql\GetStatus');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns results matching a query expressed in Event Query Language (EQL)
     *
     * $params['index']                       = (string) The name of the index to scope the operation
     * $params['wait_for_completion_timeout'] = (time) Specify the time that the request should block waiting for the final response
     * $params['keep_on_completion']          = (boolean) Control whether the response should be stored in the cluster if it completed within the provided [wait_for_completion] time (default: false) (Default = false)
     * $params['keep_alive']                  = (time) Update the time interval in which the results (partial or final) for this search will be available (Default = 5d)
     * $params['body']                        = (array) Eql request body. Use the `query` to limit the query scope. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/eql-search-api.html
     */
    public function search(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Eql\Search $endpoint */
        $endpoint = $endpointBuilder('Eql\Search');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}
