<?php
/**
 * Created by PhpStorm.
 * Author: XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/3/4 11:31:51
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Indices;

/**
 * Class IndicesNamespace
 */
class IndicesNamespace extends AbstractNamespace
{
    /**
     * Creates an index with optional settings and mappings.
     *
     * $params['index']                  = (string) The name of the index
     * $params['include_type_name']      = (boolean) Whether a type should be expected in the body of the mappings.
     * $params['wait_for_active_shards'] = (string) Set the number of active shards to wait for before the operation returns.
     * $params['timeout']                = (time) Explicit operation timeout
     * $params['master_timeout']         = (time) Specify timeout for connection to master
     * $params['body']                   = (array) The configuration for the index (`settings` and `mappings`)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/indices-create-index.html
     */
    public function create(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Indices\Create $endpoint */
        $endpoint = $endpointBuilder('Indices\Create');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes an index.
     *
     * $params['index']              = (list) A comma-separated list of indices to delete; use `_all` or `*` string to delete all indices
     * $params['timeout']            = (time) Explicit operation timeout
     * $params['master_timeout']     = (time) Specify timeout for connection to master
     * $params['ignore_unavailable'] = (boolean) Ignore unavailable indexes (default: false)
     * $params['allow_no_indices']   = (boolean) Ignore if a wildcard expression resolves to no concrete indices (default: false)
     * $params['expand_wildcards']   = (enum) Whether wildcard expressions should get expanded to open, closed, or hidden indices (Options = open,closed,hidden,none,all) (Default = open,closed)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/indices-delete-index.html
     */
    public function delete(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Indices\Delete $endpoint */
        $endpoint = $endpointBuilder('Indices\Delete');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns mappings for one or more indices.
     *
     * $params['index']              = (list) A comma-separated list of index names
     * $params['type']               = DEPRECATED (list) A comma-separated list of document types
     * $params['include_type_name']  = (boolean) Whether to add the type name to the response (default: false)
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['master_timeout']     = (time) Specify timeout for connection to master
     * $params['local']              = (boolean) Return local information, do not retrieve the state from master node (default: false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/indices-get-mapping.html
     */
    public function getMapping(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        $endpointBuilder = $this->endpoints;
        /** @var Indices\GetMapping $endpoint */
        $endpoint = $endpointBuilder('Indices\GetMapping');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns settings for one or more indices.
     *
     * $params['index']              = (list) A comma-separated list of index names; use `_all` or empty string to perform the operation on all indices
     * $params['name']               = (list) The name of the settings that should be included
     * $params['master_timeout']     = (time) Specify timeout for connection to master
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = all)
     * $params['flat_settings']      = (boolean) Return settings in flat format (default: false)
     * $params['local']              = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['include_defaults']   = (boolean) Whether to return all default setting for each of the indices. (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/indices-get-settings.html
     */
    public function getSettings(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Indices\GetSettings $endpoint */
        $endpoint = $endpointBuilder('Indices\GetSettings');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates the index mappings.
     *
     * $params['index']              = (list) A comma-separated list of index names the mapping should be added to (supports wildcards); use `_all` or omit to add the mapping on all indices.
     * $params['type']               = DEPRECATED (string) The name of the document type
     * $params['include_type_name']  = (boolean) Whether a type should be expected in the body of the mappings.
     * $params['timeout']            = (time) Explicit operation timeout
     * $params['master_timeout']     = (time) Specify timeout for connection to master
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['write_index_only']   = (boolean) When true, applies mappings only to the write index of an alias or data stream (Default = false)
     * $params['body']               = (array) The mapping definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/indices-put-mapping.html
     */
    public function putMapping(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Indices\PutMapping $endpoint */
        $endpoint = $endpointBuilder('Indices\PutMapping');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates the index settings.
     *
     * $params['index']              = (list) A comma-separated list of index names; use `_all` or empty string to perform the operation on all indices
     * $params['master_timeout']     = (time) Specify timeout for connection to master
     * $params['timeout']            = (time) Explicit operation timeout
     * $params['preserve_existing']  = (boolean) Whether to update existing settings. If set to `true` existing settings on an index remain unchanged, the default is `false`
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['flat_settings']      = (boolean) Return settings in flat format (default: false)
     * $params['body']               = (array) The index settings to be updated (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/indices-update-settings.html
     */
    public function putSettings(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Indices\PutSettings $endpoint */
        $endpoint = $endpointBuilder('Indices\PutSettings');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}
