<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:27:46
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\SearchableSnapshots;

/**
 * Class SearchableSnapshotsNamespace
 */
class SearchableSnapshotsNamespace extends AbstractNamespace
{
    /**
     * Retrieve node-level cache statistics about searchable snapshots.
     *
     * $params['node_id'] = (list) A comma-separated list of node IDs or names to limit the returned information; use `_local` to return information from the node you're connecting to, leave empty to get information from all nodes
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/searchable-snapshots-apis.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function cacheStats(array $params = [])
    {
        $node_id = $this->extractArgument($params, 'node_id');

        $endpointBuilder = $this->endpoints;
        /** @var SearchableSnapshots\CacheStats $endpoint */
        $endpoint = $endpointBuilder('SearchableSnapshots\CacheStats');
        $endpoint->setParams($params);
        $endpoint->setNodeId($node_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Clear the cache of searchable snapshots.
     *
     * $params['index']              = (list) A comma-separated list of index names
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,none,all) (Default = open)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/searchable-snapshots-apis.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function clearCache(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var SearchableSnapshots\ClearCache $endpoint */
        $endpoint = $endpointBuilder('SearchableSnapshots\ClearCache');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Mount a snapshot as a searchable index.
     *
     * $params['repository']          = (string) The name of the repository containing the snapshot of the index to mount
     * $params['snapshot']            = (string) The name of the snapshot of the index to mount
     * $params['master_timeout']      = (time) Explicit operation timeout for connection to master node
     * $params['wait_for_completion'] = (boolean) Should this request wait until the operation has completed before returning (Default = false)
     * $params['storage']             = (string) Selects the kind of local storage used to accelerate searches. Experimental, and defaults to `full_copy` (Default = )
     * $params['body']                = (array) The restore configuration for mounting the snapshot as searchable (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/searchable-snapshots-api-mount-snapshot.html
     */
    public function mount(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $snapshot = $this->extractArgument($params, 'snapshot');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var SearchableSnapshots\Mount $endpoint */
        $endpoint = $endpointBuilder('SearchableSnapshots\Mount');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setSnapshot($snapshot);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * DEPRECATED: This API is replaced by the Repositories Metering API.
     *
     * $params['repository'] = (string) The repository for which to get the stats for
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/searchable-snapshots-apis.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function repositoryStats(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');

        $endpointBuilder = $this->endpoints;
        /** @var SearchableSnapshots\RepositoryStats $endpoint */
        $endpoint = $endpointBuilder('SearchableSnapshots\RepositoryStats');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieve shard-level statistics about searchable snapshots.
     *
     * $params['index'] = (list) A comma-separated list of index names
     * $params['level'] = (enum) Return stats aggregated at cluster, index or shard level (Options = cluster,indices,shards) (Default = indices)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/searchable-snapshots-apis.html
     */
    public function stats(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var SearchableSnapshots\Stats $endpoint */
        $endpoint = $endpointBuilder('SearchableSnapshots\Stats');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }
}