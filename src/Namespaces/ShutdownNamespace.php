<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:04:06
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Shutdown;

/**
 * Class ShutdownNamespace
 */
class ShutdownNamespace extends AbstractNamespace
{
    /**
     * Removes a node from the shutdown list. Designed for indirect use by ECE/ESS and ECK. Direct use is not supported.
     *
     * $params['node_id'] = (string) The node id of node to be removed from the shutdown state
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current
     */
    public function deleteNode(array $params = [])
    {
        $node_id = $this->extractArgument($params, 'node_id');

        $endpointBuilder = $this->endpoints;
        /** @var Shutdown\DeleteNode $endpoint */
        $endpoint = $endpointBuilder('Shutdown\DeleteNode');
        $endpoint->setParams($params);
        $endpoint->setNodeId($node_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieve status of a node or nodes that are currently marked as shutting down. Designed for indirect use by ECE/ESS and ECK. Direct use is not supported.
     *
     * $params['node_id'] = (string) Which node for which to retrieve the shutdown status
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current
     */
    public function getNode(array $params = [])
    {
        $node_id = $this->extractArgument($params, 'node_id');

        $endpointBuilder = $this->endpoints;
        /** @var Shutdown\GetNode $endpoint */
        $endpoint = $endpointBuilder('Shutdown\GetNode');
        $endpoint->setParams($params);
        $endpoint->setNodeId($node_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Adds a node to be shut down. Designed for indirect use by ECE/ESS and ECK. Direct use is not supported.
     *
     * $params['node_id'] = (string) The node id of node to be shut down
     * $params['body']    = (array) The shutdown type definition to register (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current
     */
    public function putNode(array $params = [])
    {
        $node_id = $this->extractArgument($params, 'node_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Shutdown\PutNode $endpoint */
        $endpoint = $endpointBuilder('Shutdown\PutNode');
        $endpoint->setParams($params);
        $endpoint->setNodeId($node_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}