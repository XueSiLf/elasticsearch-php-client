<?php
/**
 * Created by PhpStorm.
 * Author: XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/11 18:30:31
 */

namespace LavaMusic\ElasticSearch;

use LavaMusic\ElasticSearch\Common\Exceptions\BadMethodCallException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;
use LavaMusic\ElasticSearch\Namespaces\AbstractNamespace;
use LavaMusic\ElasticSearch\Namespaces\IndicesNamespace;
use LavaMusic\ElasticSearch\Namespaces\NamespaceBuilderInterface;
use LavaMusic\ElasticSearch\Endpoints;

/**
 * Class Client
 * @package LavaMusic\ElasticSearch
 */
class Client
{
    const VERSION = '7.17.0';

    /**
     * @var Transport
     */
    public $transport;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var callable
     */
    protected $endpoints;

    /**
     * @var NamespaceBuilderInterface[]
     */
    protected $registeredNamespaces = [];

    /**
     * @var IndicesNamespace
     */
    protected $indices;

    /**
     * Client constructor
     *
     * @param Transport $transport
     * @param callable $endpoint
     * @param AbstractNamespace[] $registeredNamespaces
     */
    public function __construct(Transport $transport, callable $endpoint, array $registeredNamespaces)
    {
        $this->transport = $transport;
        $this->endpoints = $endpoint;

        $this->indices = new IndicesNamespace($transport, $endpoint);
    }

    /**
     * Allows to perform multiple index/update/delete operations in a single request.
     *
     * $params['index']                  = (string) Default index for items which don't provide one
     * $params['type']                   = DEPRECATED (string) Default document type for items which don't provide one
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the bulk operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['refresh']                = (enum) If `true` then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` (the default) then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['routing']                = (string) Specific routing value
     * $params['timeout']                = (time) Explicit operation timeout
     * $params['_source']                = (list) True or false to return the _source field or not, or default list of fields to return, can be overridden on each sub-request
     * $params['_source_excludes']       = (list) Default list of fields to exclude from the returned _source field, can be overridden on each sub-request
     * $params['_source_includes']       = (list) Default list of fields to extract and return from the _source field, can be overridden on each sub-request
     * $params['pipeline']               = (string) The pipeline id to preprocess incoming documents with
     * $params['require_alias']          = (boolean) Sets require_alias for all incoming documents. Defaults to unset (false)
     * $params['body']                   = (array) The operation definition and data (action-data pairs), separated by newlines (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-bulk.html
     */
    public function bulk(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Bulk $endpoint */
        $endpoint = $endpointBuilder('Bulk');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Removes a document from the index.
     *
     * $params['id']                     = (string) The document ID (Required)
     * $params['index']                  = (string) The name of the index (Required)
     * $params['type']                   = DEPRECATED (string) The type of the document
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the delete operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['refresh']                = (enum) If `true` then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` (the default) then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['routing']                = (string) Specific routing value
     * $params['timeout']                = (time) Explicit operation timeout
     * $params['if_seq_no']              = (number) only perform the delete operation if the last operation that has changed the document has the specified sequence number
     * $params['if_primary_term']        = (number) only perform the delete operation if the last operation that has changed the document has the specified primary term
     * $params['version']                = (number) Explicit version number for concurrency control
     * $params['version_type']           = (enum) Specific version type (Options = internal,external,external_gte,force)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-delete.html
     */
    public function delete(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Delete $endpoint */
        $endpoint = $endpointBuilder('Delete');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setIndex($index);
        $endpoint->setType($type);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns a document.
     *
     * $params['id']               = (string) The document ID (Required)
     * $params['index']            = (string) The name of the index (Required)
     * $params['type']             = DEPRECATED (string) The type of the document (use `_all` to fetch the first document matching the ID across all types)
     * $params['stored_fields']    = (list) A comma-separated list of stored fields to return in the response
     * $params['preference']       = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['realtime']         = (boolean) Specify whether to perform the operation in realtime or search mode
     * $params['refresh']          = (boolean) Refresh the shard containing the document before performing the operation
     * $params['routing']          = (string) Specific routing value
     * $params['_source']          = (list) True or false to return the _source field or not, or a list of fields to return
     * $params['_source_excludes'] = (list) A list of fields to exclude from the returned _source field
     * $params['_source_includes'] = (list) A list of fields to extract and return from the _source field
     * $params['version']          = (number) Explicit version number for concurrency control
     * $params['version_type']     = (enum) Specific version type (Options = internal,external,external_gte,force)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-get.html
     */
    public function get(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Get $endpoint */
        $endpoint = $endpointBuilder('Get');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setIndex($index);
        $endpoint->setType($type);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates or updates a document in an index.
     *
     * $params['id']                     = (string) Document ID
     * $params['index']                  = (string) The name of the index (Required)
     * $params['type']                   = DEPRECATED (string) The type of the document
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the index operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['op_type']                = (enum) Explicit operation type. Defaults to `index` for requests with an explicit document ID, and to `create`for requests without an explicit document ID (Options = index,create)
     * $params['refresh']                = (enum) If `true` then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` (the default) then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['routing']                = (string) Specific routing value
     * $params['timeout']                = (time) Explicit operation timeout
     * $params['version']                = (number) Explicit version number for concurrency control
     * $params['version_type']           = (enum) Specific version type (Options = internal,external,external_gte)
     * $params['if_seq_no']              = (number) only perform the index operation if the last operation that has changed the document has the specified sequence number
     * $params['if_primary_term']        = (number) only perform the index operation if the last operation that has changed the document has the specified primary term
     * $params['pipeline']               = (string) The pipeline id to preprocess incoming documents with
     * $params['require_alias']          = (boolean) When true, requires destination to be an alias. Default is false
     * $params['body']                   = (array) The document (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-index_.html
     */
    public function index(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Index $endpoint */
        $endpoint = $endpointBuilder('Index');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns basic information about the cluster.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html
     */
    public function info(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Info $endpoint */
        $endpoint = $endpointBuilder('Info');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns results matching a query.
     *
     * $params['index']                         = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices
     * $params['type']                          = DEPRECATED (list) A comma-separated list of document types to search; leave empty to perform the operation on all types
     * $params['analyzer']                      = (string) The analyzer to use for the query string
     * $params['analyze_wildcard']              = (boolean) Specify whether wildcard and prefix queries should be analyzed (default: false)
     * $params['ccs_minimize_roundtrips']       = (boolean) Indicates whether network round-trips should be minimized as part of cross-cluster search requests execution (Default = true)
     * $params['default_operator']              = (enum) The default operator for query string query (AND or OR) (Options = AND,OR) (Default = OR)
     * $params['df']                            = (string) The field to use as default where no field prefix is given in the query string
     * $params['explain']                       = (boolean) Specify whether to return detailed information about score computation as part of a hit
     * $params['stored_fields']                 = (list) A comma-separated list of stored fields to return as part of a hit
     * $params['docvalue_fields']               = (list) A comma-separated list of fields to return as the docvalue representation of a field for each hit
     * $params['from']                          = (number) Starting offset (default: 0)
     * $params['ignore_unavailable']            = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['ignore_throttled']              = (boolean) Whether specified concrete, expanded or aliased indices should be ignored when throttled
     * $params['allow_no_indices']              = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']              = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['lenient']                       = (boolean) Specify whether format-based query failures (such as providing text to a numeric field) should be ignored
     * $params['preference']                    = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['q']                             = (string) Query in the Lucene query string syntax
     * $params['routing']                       = (list) A comma-separated list of specific routing values
     * $params['scroll']                        = (time) Specify how long a consistent view of the index should be maintained for scrolled search
     * $params['search_type']                   = (enum) Search operation type (Options = query_then_fetch,dfs_query_then_fetch)
     * $params['size']                          = (number) Number of hits to return (default: 10)
     * $params['sort']                          = (list) A comma-separated list of <field>:<direction> pairs
     * $params['_source']                       = (list) True or false to return the _source field or not, or a list of fields to return
     * $params['_source_excludes']              = (list) A list of fields to exclude from the returned _source field
     * $params['_source_includes']              = (list) A list of fields to extract and return from the _source field
     * $params['terminate_after']               = (number) The maximum number of documents to collect for each shard, upon reaching which the query execution will terminate early.
     * $params['stats']                         = (list) Specific 'tag' of the request for logging and statistical purposes
     * $params['suggest_field']                 = (string) Specify which field to use for suggestions
     * $params['suggest_mode']                  = (enum) Specify suggest mode (Options = missing,popular,always) (Default = missing)
     * $params['suggest_size']                  = (number) How many suggestions to return in response
     * $params['suggest_text']                  = (string) The source text for which the suggestions should be returned
     * $params['timeout']                       = (time) Explicit operation timeout
     * $params['track_scores']                  = (boolean) Whether to calculate and return scores even if they are not used for sorting
     * $params['track_total_hits']              = (boolean) Indicate if the number of documents that match the query should be tracked
     * $params['allow_partial_search_results']  = (boolean) Indicate if an error should be returned if there is a partial search failure or timeout (Default = true)
     * $params['typed_keys']                    = (boolean) Specify whether aggregation and suggester names should be prefixed by their respective types in the response
     * $params['version']                       = (boolean) Specify whether to return document version as part of a hit
     * $params['seq_no_primary_term']           = (boolean) Specify whether to return sequence number and primary term of the last modification of each hit
     * $params['request_cache']                 = (boolean) Specify if request cache should be used for this request or not, defaults to index level setting
     * $params['batched_reduce_size']           = (number) The number of shard results that should be reduced at once on the coordinating node. This value should be used as a protection mechanism to reduce the memory overhead per search request if the potential number of shards in the request can be large. (Default = 512)
     * $params['max_concurrent_shard_requests'] = (number) The number of concurrent shard requests per node this search executes concurrently. This value should be used to limit the impact of the search on the cluster in order to limit the number of concurrent shard requests (Default = 5)
     * $params['pre_filter_shard_size']         = (number) A threshold that enforces a pre-filter roundtrip to prefilter search shards based on query rewriting if the number of shards the search request expands to exceeds the threshold. This filter roundtrip can limit the number of shards significantly if for instance a shard can not match any documents based on its rewrite method ie. if date filters are mandatory to match but the shard bounds and the query are disjoint.
     * $params['rest_total_hits_as_int']        = (boolean) Indicates whether hits.total should be rendered as an integer or an object in the rest search response (Default = false)
     * $params['min_compatible_shard_node']     = (string) The minimum compatible version that all shards involved in search should have for this request to be successful
     * $params['body']                          = (array) The search definition using the Query DSL
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-search.html
     */
    public function search(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Search $endpoint */
        $endpoint = $endpointBuilder('Search');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates a document with a script or partial document.
     *
     * $params['id']                     = (string) Document ID (Required)
     * $params['index']                  = (string) The name of the index (Required)
     * $params['type']                   = DEPRECATED (string) The type of the document
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the update operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['_source']                = (list) True or false to return the _source field or not, or a list of fields to return
     * $params['_source_excludes']       = (list) A list of fields to exclude from the returned _source field
     * $params['_source_includes']       = (list) A list of fields to extract and return from the _source field
     * $params['lang']                   = (string) The script language (default: painless)
     * $params['refresh']                = (enum) If `true` then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` (the default) then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['retry_on_conflict']      = (number) Specify how many times should the operation be retried when a conflict occurs (default: 0)
     * $params['routing']                = (string) Specific routing value
     * $params['timeout']                = (time) Explicit operation timeout
     * $params['if_seq_no']              = (number) only perform the update operation if the last operation that has changed the document has the specified sequence number
     * $params['if_primary_term']        = (number) only perform the update operation if the last operation that has changed the document has the specified primary term
     * $params['require_alias']          = (boolean) When true, requires destination is an alias. Default is false
     * $params['body']                   = (array) The request definition requires either `script` or partial `doc` (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-update.html
     */
    public function update(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Update $endpoint */
        $endpoint = $endpointBuilder('Update');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the indices namespace
     */
    public function indices(): IndicesNamespace
    {
        return $this->indices;
    }

    /**
     * Catchall for registered namespaces
     *
     * @return object
     * @throws BadMethodCallException if the namespace cannot be found
     */
    public function __call(string $name, array $arguments)
    {
        if (isset($this->registeredNamespaces[$name])) {
            return $this->registeredNamespaces[$name];
        }
        throw new BadMethodCallException("Namespace [$name] not found");
    }

    /**
     * Extract an argument from the array of parameters
     *
     * @return null|mixed
     */
    public function extractArgument(array &$params, string $arg)
    {
        if (array_key_exists($arg, $params) === true) {
            $value = $params[$arg];
            $value = (is_object($value) && !is_iterable($value)) ?
                (array)$value :
                $value;
            unset($params[$arg]);
            return $value;
        } else {
            return null;
        }
    }

    /**
     * @param AbstractEndpoint $endpoint
     * @return array|mixed
     * @throws Common\Exceptions\NoNodesAvailableException
     */
    private function performRequest(AbstractEndpoint $endpoint)
    {
        return $this->transport->performRequest(
            $endpoint->getMethod(),
            $endpoint->getURI(),
            $endpoint->getParams(),
            $endpoint->getBody(),
            $endpoint->getOptions()
        );
    }
}
