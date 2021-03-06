<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:19:56
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\DanglingIndices;

/**
 * Class DanglingIndicesNamespace
 */
class DanglingIndicesNamespace extends AbstractNamespace
{
    /**
     * Deletes the specified dangling index
     *
     * $params['index_uuid']       = (string) The UUID of the dangling index
     * $params['accept_data_loss'] = (boolean) Must be set to true in order to delete the dangling index
     * $params['timeout']          = (time) Explicit operation timeout
     * $params['master_timeout']   = (time) Specify timeout for connection to master
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-gateway-dangling-indices.html
     */
    public function deleteDanglingIndex(array $params = [])
    {
        $index_uuid = $this->extractArgument($params, 'index_uuid');

        $endpointBuilder = $this->endpoints;
        /** @var DanglingIndices\DeleteDanglingIndex $endpoint */
        $endpoint = $endpointBuilder('DanglingIndices\DeleteDanglingIndex');
        $endpoint->setParams($params);
        $endpoint->setIndexUuid($index_uuid);

        return $this->performRequest($endpoint);
    }

    /**
     * Imports the specified dangling index
     *
     * $params['index_uuid']       = (string) The UUID of the dangling index
     * $params['accept_data_loss'] = (boolean) Must be set to true in order to import the dangling index
     * $params['timeout']          = (time) Explicit operation timeout
     * $params['master_timeout']   = (time) Specify timeout for connection to master
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-gateway-dangling-indices.html
     */
    public function importDanglingIndex(array $params = [])
    {
        $index_uuid = $this->extractArgument($params, 'index_uuid');

        $endpointBuilder = $this->endpoints;
        /** @var DanglingIndices\ImportDanglingIndex $endpoint */
        $endpoint = $endpointBuilder('DanglingIndices\ImportDanglingIndex');
        $endpoint->setParams($params);
        $endpoint->setIndexUuid($index_uuid);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns all dangling indices.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-gateway-dangling-indices.html
     */
    public function listDanglingIndices(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var DanglingIndices\ListDanglingIndices $endpoint */
        $endpoint = $endpointBuilder('DanglingIndices\ListDanglingIndices');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}
