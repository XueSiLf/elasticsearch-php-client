<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:43:08
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Fleet;

/**
 * Class FleetNamespace
 */
class FleetNamespace extends AbstractNamespace
{
    /**
     * Returns the current global checkpoints for an index. This API is design for internal use by the fleet server project.
     *
     * $params['index']            = (string) The name of the index.
     * $params['wait_for_advance'] = (boolean) Whether to wait for the global checkpoint to advance past the specified current checkpoints (Default = true)
     * $params['wait_for_index']   = (boolean) Whether to wait for the target index to exist and all primary shards be active (Default = true)
     * $params['checkpoints']      = (list) Comma separated list of checkpoints (Default = )
     * $params['timeout']          = (time) Timeout to wait for global checkpoint to advance (Default = 30s)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-global-checkpoints.html
     */
    public function globalCheckpoints(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Fleet\GlobalCheckpoints $endpoint */
        $endpoint = $endpointBuilder('Fleet\GlobalCheckpoints');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Multi Search API where the search will only be executed after specified checkpoints are available due to a refresh. This API is designed for internal use by the fleet server project.
     *
     * $params['index'] = (string) The index name to use as the default
     * $params['body']  = (array) The request definitions (metadata-fleet search request definition pairs), separated by newlines (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function msearch(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Fleet\Msearch $endpoint */
        $endpoint = $endpointBuilder('Fleet\Msearch');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Search API where the search will only be executed after specified checkpoints are available due to a refresh. This API is designed for internal use by the fleet server project.
     *
     * $params['index']                        = (string) The index name to search.
     * $params['wait_for_checkpoints']         = (list) Comma separated list of checkpoints, one per shard (Default = )
     * $params['wait_for_checkpoints_timeout'] = (time) Explicit wait_for_checkpoints timeout
     * $params['allow_partial_search_results'] = (boolean) Indicate if an error should be returned if there is a partial search failure or timeout (Default = true)
     * $params['body']                         = (array) The search definition using the Query DSL
     *
     * @param array $params Associative array of parameters
     * @return array
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function search(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Fleet\Search $endpoint */
        $endpoint = $endpointBuilder('Fleet\Search');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}