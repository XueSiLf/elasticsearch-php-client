<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:30:15
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\Elasticsearch\Endpoints\Sql;

/**
 * Class SqlNamespace
 */
class SqlNamespace extends AbstractNamespace
{
    /**
     * Clears the SQL cursor
     *
     * $params['body'] = (array) Specify the cursor value in the `cursor` element to clean the cursor. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/clear-sql-cursor-api.html
     */
    public function clearCursor(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Sql\ClearCursor $endpoint */
        $endpoint = $endpointBuilder('Sql\ClearCursor');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes an async SQL search or a stored synchronous SQL search. If the search is still running, the API cancels it.
     *
     * $params['id'] = (string) The async search ID
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/delete-async-sql-search-api.html
     */
    public function deleteAsync(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Sql\DeleteAsync $endpoint */
        $endpoint = $endpointBuilder('Sql\DeleteAsync');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the current status and available results for an async SQL search or stored synchronous SQL search
     *
     * $params['id']                          = (string) The async search ID
     * $params['delimiter']                   = (string) Separator for CSV results (Default = ,)
     * $params['format']                      = (string) Short version of the Accept header, e.g. json, yaml
     * $params['keep_alive']                  = (time) Retention period for the search and its results (Default = 5d)
     * $params['wait_for_completion_timeout'] = (time) Duration to wait for complete results
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/get-async-sql-search-api.html
     */
    public function getAsync(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Sql\GetAsync $endpoint */
        $endpoint = $endpointBuilder('Sql\GetAsync');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the current status of an async SQL search or a stored synchronous SQL search
     *
     * $params['id'] = (string) The async search ID
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/get-async-sql-search-status-api.html
     */
    public function getAsyncStatus(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Sql\GetAsyncStatus $endpoint */
        $endpoint = $endpointBuilder('Sql\GetAsyncStatus');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Executes a SQL request
     *
     * $params['format'] = (string) a short version of the Accept header, e.g. json, yaml
     * $params['body']   = (array) Use the `query` element to start a query. Use the `cursor` element to continue a query. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/sql-search-api.html
     */
    public function query(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Sql\Query $endpoint */
        $endpoint = $endpointBuilder('Sql\Query');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Translates SQL into Elasticsearch queries
     *
     * $params['body'] = (array) Specify the query in the `query` element. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/sql-translate-api.html
     */
    public function translate(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Sql\Translate $endpoint */
        $endpoint = $endpointBuilder('Sql\Translate');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}