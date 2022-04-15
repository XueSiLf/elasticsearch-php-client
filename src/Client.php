<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/11 18:30:31
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch;

use LavaMusic\ElasticSearch\Common\Exceptions\BadMethodCallException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;
use LavaMusic\ElasticSearch\Namespaces\AbstractNamespace;
use LavaMusic\ElasticSearch\Namespaces\AsyncSearchNamespace;
use LavaMusic\ElasticSearch\Namespaces\AutoscalingNamespace;
use LavaMusic\ElasticSearch\Namespaces\BooleanRequestWrapper;
use LavaMusic\ElasticSearch\Namespaces\CatNamespace;
use LavaMusic\ElasticSearch\Namespaces\CcrNamespace;
use LavaMusic\ElasticSearch\Namespaces\ClusterNamespace;
use LavaMusic\ElasticSearch\Namespaces\DanglingIndicesNamespace;
use LavaMusic\ElasticSearch\Namespaces\DataFrameTransformDeprecatedNamespace;
use LavaMusic\ElasticSearch\Namespaces\EnrichNamespace;
use LavaMusic\ElasticSearch\Namespaces\EqlNamespace;
use LavaMusic\ElasticSearch\Namespaces\FeaturesNamespace;
use LavaMusic\ElasticSearch\Namespaces\FleetNamespace;
use LavaMusic\ElasticSearch\Namespaces\GraphNamespace;
use LavaMusic\ElasticSearch\Namespaces\IlmNamespace;
use LavaMusic\ElasticSearch\Namespaces\IndicesNamespace;
use LavaMusic\ElasticSearch\Namespaces\IngestNamespace;
use LavaMusic\ElasticSearch\Namespaces\LicenseNamespace;
use LavaMusic\ElasticSearch\Namespaces\LogstashNamespace;
use LavaMusic\ElasticSearch\Namespaces\MigrationNamespace;
use LavaMusic\ElasticSearch\Namespaces\MlNamespace;
use LavaMusic\ElasticSearch\Namespaces\MonitoringNamespace;
use LavaMusic\ElasticSearch\Namespaces\NamespaceBuilderInterface;
use LavaMusic\ElasticSearch\Endpoints;
use LavaMusic\ElasticSearch\Namespaces\NodesNamespace;
use LavaMusic\ElasticSearch\Namespaces\RollupNamespace;
use LavaMusic\ElasticSearch\Namespaces\SearchableSnapshotsNamespace;
use LavaMusic\ElasticSearch\Namespaces\SecurityNamespace;
use LavaMusic\ElasticSearch\Namespaces\ShutdownNamespace;
use LavaMusic\ElasticSearch\Namespaces\SlmNamespace;
use LavaMusic\ElasticSearch\Namespaces\SnapshotNamespace;
use LavaMusic\ElasticSearch\Namespaces\SqlNamespace;
use LavaMusic\ElasticSearch\Namespaces\SslNamespace;
use LavaMusic\ElasticSearch\Namespaces\TasksNamespace;
use LavaMusic\ElasticSearch\Namespaces\TextStructureNamespace;
use LavaMusic\ElasticSearch\Namespaces\TransformNamespace;
use LavaMusic\ElasticSearch\Namespaces\WatcherNamespace;
use LavaMusic\ElasticSearch\Namespaces\XpackNamespace;

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
     * @var AsyncSearchNamespace
     */
    protected $asyncSearch;

    /**
     * @var AutoscalingNamespace
     */
    protected $autoscaling;

    /**
     * @var CatNamespace
     */
    protected $cat;

    /**
     * @var CcrNamespace
     */
    protected $ccr;

    /**
     * @var ClusterNamespace
     */
    protected $cluster;

    /**
     * @var DanglingIndicesNamespace
     */
    protected $danglingIndices;

    /**
     * @var DataFrameTransformDeprecatedNamespace
     */
    protected $dataFrameTransformDeprecated;

    /**
     * @var EnrichNamespace
     */
    protected $enrich;

    /**
     * @var EqlNamespace
     */
    protected $eql;

    /**
     * @var FeaturesNamespace
     */
    protected $features;

    /**
     * @var FleetNamespace
     */
    protected $fleet;

    /**
     * @var GraphNamespace
     */
    protected $graph;

    /**
     * @var IlmNamespace
     */
    protected $ilm;

    /**
     * @var IndicesNamespace
     */
    protected $indices;

    /**
     * @var IngestNamespace
     */
    protected $ingest;

    /**
     * @var LicenseNamespace
     */
    protected $license;

    /**
     * @var LogstashNamespace
     */
    protected $logstash;

    /**
     * @var MigrationNamespace
     */
    protected $migration;

    /**
     * @var MlNamespace
     */
    protected $ml;

    /**
     * @var MonitoringNamespace
     */
    protected $monitoring;

    /**
     * @var NodesNamespace
     */
    protected $nodes;

    /**
     * @var RollupNamespace
     */
    protected $rollup;

    /**
     * @var SearchableSnapshotsNamespace
     */
    protected $searchableSnapshots;

    /**
     * @var SecurityNamespace
     */
    protected $security;

    /**
     * @var ShutdownNamespace
     */
    protected $shutdown;

    /**
     * @var SlmNamespace
     */
    protected $slm;

    /**
     * @var SnapshotNamespace
     */
    protected $snapshot;

    /**
     * @var SqlNamespace
     */
    protected $sql;

    /**
     * @var SslNamespace
     */
    protected $ssl;

    /**
     * @var TasksNamespace
     */
    protected $tasks;

    /**
     * @var TextStructureNamespace
     */
    protected $textStructure;

    /**
     * @var TransformNamespace
     */
    protected $transform;

    /**
     * @var WatcherNamespace
     */
    protected $watcher;

    /**
     * @var XpackNamespace
     */
    protected $xpack;

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
        $this->asyncSearch = new AsyncSearchNamespace($transport, $endpoint);
        $this->autoscaling = new AutoscalingNamespace($transport, $endpoint);
        $this->cat = new CatNamespace($transport, $endpoint);
        $this->ccr = new CcrNamespace($transport, $endpoint);
        $this->cluster = new ClusterNamespace($transport, $endpoint);
        $this->danglingIndices = new DanglingIndicesNamespace($transport, $endpoint);
        $this->dataFrameTransformDeprecated = new DataFrameTransformDeprecatedNamespace($transport, $endpoint);
        $this->enrich = new EnrichNamespace($transport, $endpoint);
        $this->eql = new EqlNamespace($transport, $endpoint);
        $this->features = new FeaturesNamespace($transport, $endpoint);
        $this->fleet = new FleetNamespace($transport, $endpoint);
        $this->graph = new GraphNamespace($transport, $endpoint);
        $this->ilm = new IlmNamespace($transport, $endpoint);
        $this->indices = new IndicesNamespace($transport, $endpoint);
        $this->ingest = new IngestNamespace($transport, $endpoint);
        $this->license = new LicenseNamespace($transport, $endpoint);
        $this->logstash = new LogstashNamespace($transport, $endpoint);
        $this->migration = new MigrationNamespace($transport, $endpoint);
        $this->ml = new MlNamespace($transport, $endpoint);
        $this->monitoring = new MonitoringNamespace($transport, $endpoint);
        $this->nodes = new NodesNamespace($transport, $endpoint);
        $this->rollup = new RollupNamespace($transport, $endpoint);
        $this->searchableSnapshots = new SearchableSnapshotsNamespace($transport, $endpoint);
        $this->security = new SecurityNamespace($transport, $endpoint);
        $this->shutdown = new ShutdownNamespace($transport, $endpoint);
        $this->slm = new SlmNamespace($transport, $endpoint);
        $this->snapshot = new SnapshotNamespace($transport, $endpoint);
        $this->sql = new SqlNamespace($transport, $endpoint);
        $this->ssl = new SslNamespace($transport, $endpoint);
        $this->tasks = new TasksNamespace($transport, $endpoint);
        $this->textStructure = new TextStructureNamespace($transport, $endpoint);
        $this->transform = new TransformNamespace($transport, $endpoint);
        $this->watcher = new WatcherNamespace($transport, $endpoint);
        $this->xpack = new XpackNamespace($transport, $endpoint);

        $this->registeredNamespaces = $registeredNamespaces;
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
     * Explicitly clears the search context for a scroll.
     *
     * $params['scroll_id'] = DEPRECATED (list) A comma-separated list of scroll IDs to clear
     * $params['body']      = (array) A comma-separated list of scroll IDs to clear if none was specified via the scroll_id parameter
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/clear-scroll-api.html
     */
    public function clearScroll(array $params = [])
    {
        $scroll_id = $this->extractArgument($params, 'scroll_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\ClearScroll $endpoint */
        $endpoint = $endpointBuilder('ClearScroll');
        $endpoint->setParams($params);
        $endpoint->setScrollId($scroll_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Close a point in time
     *
     * $params['body'] = (array) a point-in-time id to close
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/point-in-time-api.html
     */
    public function closePointInTime(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\ClosePointInTime $endpoint */
        $endpoint = $endpointBuilder('ClosePointInTime');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns number of documents matching a query.
     *
     * $params['index']              = (list) A comma-separated list of indices to restrict the results
     * $params['type']               = DEPRECATED (list) A comma-separated list of types to restrict the results
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['ignore_throttled']   = (boolean) Whether specified concrete, expanded or aliased indices should be ignored when throttled
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['min_score']          = (number) Include only documents with a specific `_score` value in the result
     * $params['preference']         = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['routing']            = (list) A comma-separated list of specific routing values
     * $params['q']                  = (string) Query in the Lucene query string syntax
     * $params['analyzer']           = (string) The analyzer to use for the query string
     * $params['analyze_wildcard']   = (boolean) Specify whether wildcard and prefix queries should be analyzed (default: false)
     * $params['default_operator']   = (enum) The default operator for query string query (AND or OR) (Options = AND,OR) (Default = OR)
     * $params['df']                 = (string) The field to use as default where no field prefix is given in the query string
     * $params['lenient']            = (boolean) Specify whether format-based query failures (such as providing text to a numeric field) should be ignored
     * $params['terminate_after']    = (number) The maximum count for each shard, upon reaching which the query execution will terminate early
     * $params['body']               = (array) A query to restrict the results specified with the Query DSL (optional)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-count.html
     */
    public function count(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Count $endpoint */
        $endpoint = $endpointBuilder('Count');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a new document in the index.Returns a 409 response when a document with a same ID already exists in the index.
     *
     * $params['id']                     = (string) Document ID (Required)
     * $params['index']                  = (string) The name of the index (Required)
     * $params['type']                   = DEPRECATED (string) The type of the document
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the index operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['refresh']                = (enum) If `true` then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` (the default) then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['routing']                = (string) Specific routing value
     * $params['timeout']                = (time) Explicit operation timeout
     * $params['version']                = (number) Explicit version number for concurrency control
     * $params['version_type']           = (enum) Specific version type (Options = internal,external,external_gte)
     * $params['pipeline']               = (string) The pipeline id to preprocess incoming documents with
     * $params['body']                   = (array) The document (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-index_.html
     */
    public function create(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Create $endpoint */
        $endpoint = $endpointBuilder('Create');
        $endpoint->setParams($params);
        $endpoint->setId($id);
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
     * Deletes documents matching the provided query.
     *
     * $params['index']                  = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices (Required)
     * $params['type']                   = DEPRECATED (list) A comma-separated list of document types to search; leave empty to perform the operation on all types
     * $params['analyzer']               = (string) The analyzer to use for the query string
     * $params['analyze_wildcard']       = (boolean) Specify whether wildcard and prefix queries should be analyzed (default: false)
     * $params['default_operator']       = (enum) The default operator for query string query (AND or OR) (Options = AND,OR) (Default = OR)
     * $params['df']                     = (string) The field to use as default where no field prefix is given in the query string
     * $params['from']                   = (number) Starting offset (default: 0)
     * $params['ignore_unavailable']     = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']       = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['conflicts']              = (enum) What to do when the delete by query hits version conflicts? (Options = abort,proceed) (Default = abort)
     * $params['expand_wildcards']       = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['lenient']                = (boolean) Specify whether format-based query failures (such as providing text to a numeric field) should be ignored
     * $params['preference']             = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['q']                      = (string) Query in the Lucene query string syntax
     * $params['routing']                = (list) A comma-separated list of specific routing values
     * $params['scroll']                 = (time) Specify how long a consistent view of the index should be maintained for scrolled search
     * $params['search_type']            = (enum) Search operation type (Options = query_then_fetch,dfs_query_then_fetch)
     * $params['search_timeout']         = (time) Explicit timeout for each search request. Defaults to no timeout.
     * $params['size']                   = (number) Deprecated, please use `max_docs` instead
     * $params['max_docs']               = (number) Maximum number of documents to process (default: all documents)
     * $params['sort']                   = (list) A comma-separated list of <field>:<direction> pairs
     * $params['terminate_after']        = (number) The maximum number of documents to collect for each shard, upon reaching which the query execution will terminate early.
     * $params['stats']                  = (list) Specific 'tag' of the request for logging and statistical purposes
     * $params['version']                = (boolean) Specify whether to return document version as part of a hit
     * $params['request_cache']          = (boolean) Specify if request cache should be used for this request or not, defaults to index level setting
     * $params['refresh']                = (boolean) Should the effected indexes be refreshed?
     * $params['timeout']                = (time) Time each individual bulk request should wait for shards that are unavailable. (Default = 1m)
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the delete by query operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['scroll_size']            = (number) Size on the scroll request powering the delete by query (Default = 100)
     * $params['wait_for_completion']    = (boolean) Should the request should block until the delete by query is complete. (Default = true)
     * $params['requests_per_second']    = (number) The throttle for this request in sub-requests per second. -1 means no throttle. (Default = 0)
     * $params['slices']                 = (number|string) The number of slices this task should be divided into. Defaults to 1, meaning the task isn't sliced into subtasks. Can be set to `auto`. (Default = 1)
     * $params['body']                   = (array) The search definition using the Query DSL (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-delete-by-query.html
     */
    public function deleteByQuery(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\DeleteByQuery $endpoint */
        $endpoint = $endpointBuilder('DeleteByQuery');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Changes the number of requests per second for a particular Delete By Query operation.
     *
     * $params['task_id']             = (string) The task id to rethrottle
     * $params['requests_per_second'] = (number) The throttle to set on this request in floating sub-requests per second. -1 means set no throttle. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-delete-by-query.html
     */
    public function deleteByQueryRethrottle(array $params = [])
    {
        $task_id = $this->extractArgument($params, 'task_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\DeleteByQueryRethrottle $endpoint */
        $endpoint = $endpointBuilder('DeleteByQueryRethrottle');
        $endpoint->setParams($params);
        $endpoint->setTaskId($task_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes a script.
     *
     * $params['id']             = (string) Script ID
     * $params['timeout']        = (time) Explicit operation timeout
     * $params['master_timeout'] = (time) Specify timeout for connection to master
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-scripting.html
     */
    public function deleteScript(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\DeleteScript $endpoint */
        $endpoint = $endpointBuilder('DeleteScript');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about whether a document exists in an index.
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
     * @return bool
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-get.html
     */
    public function exists(array $params = []): bool
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        // manually make this verbose so we can check status code
        $params['client']['verbose'] = true;

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Exists $endpoint */
        $endpoint = $endpointBuilder('Exists');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setIndex($index);
        $endpoint->setType($type);

        return BooleanRequestWrapper::performRequest($endpoint, $this->transport);
    }

    /**
     * Returns information about whether a document source exists in an index.
     *
     * $params['id']               = (string) The document ID (Required)
     * $params['index']            = (string) The name of the index (Required)
     * $params['type']             = DEPRECATED (string) The type of the document; deprecated and optional starting with 7.0
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
     * @return bool
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-get.html
     */
    public function existsSource(array $params = []): bool
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        // manually make this verbose so we can check status code
        $params['client']['verbose'] = true;

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\ExistsSource $endpoint */
        $endpoint = $endpointBuilder('ExistsSource');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setIndex($index);
        $endpoint->setType($type);

        return BooleanRequestWrapper::performRequest($endpoint, $this->transport);
    }

    /**
     * Returns information about why a specific matches (or doesn't match) a query.
     *
     * $params['id']               = (string) The document ID (Required)
     * $params['index']            = (string) The name of the index (Required)
     * $params['type']             = DEPRECATED (string) The type of the document
     * $params['analyze_wildcard'] = (boolean) Specify whether wildcards and prefix queries in the query string query should be analyzed (default: false)
     * $params['analyzer']         = (string) The analyzer for the query string query
     * $params['default_operator'] = (enum) The default operator for query string query (AND or OR) (Options = AND,OR) (Default = OR)
     * $params['df']               = (string) The default field for query string query (default: _all)
     * $params['stored_fields']    = (list) A comma-separated list of stored fields to return in the response
     * $params['lenient']          = (boolean) Specify whether format-based query failures (such as providing text to a numeric field) should be ignored
     * $params['preference']       = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['q']                = (string) Query in the Lucene query string syntax
     * $params['routing']          = (string) Specific routing value
     * $params['_source']          = (list) True or false to return the _source field or not, or a list of fields to return
     * $params['_source_excludes'] = (list) A list of fields to exclude from the returned _source field
     * $params['_source_includes'] = (list) A list of fields to extract and return from the _source field
     * $params['body']             = (array) The query definition using the Query DSL
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-explain.html
     */
    public function explain(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Explain $endpoint */
        $endpoint = $endpointBuilder('Explain');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the information about the capabilities of fields among multiple indices.
     *
     * $params['index']              = (list) A comma-separated list of index names; use `_all` or empty string to perform the operation on all indices
     * $params['fields']             = (list) A comma-separated list of field names
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['include_unmapped']   = (boolean) Indicates whether unmapped fields should be included in the response. (Default = false)
     * $params['body']               = (array) An index filter specified with the Query DSL
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-field-caps.html
     */
    public function fieldCaps(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\FieldCaps $endpoint */
        $endpoint = $endpointBuilder('FieldCaps');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

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
     * Returns a script.
     *
     * $params['id']             = (string) Script ID
     * $params['master_timeout'] = (time) Specify timeout for connection to master
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-scripting.html
     */
    public function getScript(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\GetScript $endpoint */
        $endpoint = $endpointBuilder('GetScript');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns all script contexts.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/painless/master/painless-contexts.html
     */
    public function getScriptContext(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\GetScriptContext $endpoint */
        $endpoint = $endpointBuilder('GetScriptContext');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns available script types, languages and contexts
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-scripting.html
     */
    public function getScriptLanguages(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\GetScriptLanguages $endpoint */
        $endpoint = $endpointBuilder('GetScriptLanguages');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the source of a document.
     *
     * $params['id']               = (string) The document ID (Required)
     * $params['index']            = (string) The name of the index (Required)
     * $params['type']             = DEPRECATED (string) The type of the document; deprecated and optional starting with 7.0
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
    public function getSource(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\GetSource $endpoint */
        $endpoint = $endpointBuilder('GetSource');
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
     * Allows to get multiple documents in one request.
     *
     * $params['index']            = (string) The name of the index
     * $params['type']             = DEPRECATED (string) The type of the document
     * $params['stored_fields']    = (list) A comma-separated list of stored fields to return in the response
     * $params['preference']       = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['realtime']         = (boolean) Specify whether to perform the operation in realtime or search mode
     * $params['refresh']          = (boolean) Refresh the shard containing the document before performing the operation
     * $params['routing']          = (string) Specific routing value
     * $params['_source']          = (list) True or false to return the _source field or not, or a list of fields to return
     * $params['_source_excludes'] = (list) A list of fields to exclude from the returned _source field
     * $params['_source_includes'] = (list) A list of fields to extract and return from the _source field
     * $params['body']             = (array) Document identifiers; can be either `docs` (containing full document information) or `ids` (when index and type is provided in the URL. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-multi-get.html
     */
    public function mget(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Mget $endpoint */
        $endpoint = $endpointBuilder('Mget');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to execute several search operations in one request.
     *
     * $params['index']                         = (list) A comma-separated list of index names to use as default
     * $params['type']                          = DEPRECATED (list) A comma-separated list of document types to use as default
     * $params['search_type']                   = (enum) Search operation type (Options = query_then_fetch,dfs_query_then_fetch)
     * $params['max_concurrent_searches']       = (number) Controls the maximum number of concurrent searches the multi search api will execute
     * $params['typed_keys']                    = (boolean) Specify whether aggregation and suggester names should be prefixed by their respective types in the response
     * $params['pre_filter_shard_size']         = (number) A threshold that enforces a pre-filter roundtrip to prefilter search shards based on query rewriting if the number of shards the search request expands to exceeds the threshold. This filter roundtrip can limit the number of shards significantly if for instance a shard can not match any documents based on its rewrite method ie. if date filters are mandatory to match but the shard bounds and the query are disjoint.
     * $params['max_concurrent_shard_requests'] = (number) The number of concurrent shard requests each sub search executes concurrently per node. This value should be used to limit the impact of the search on the cluster in order to limit the number of concurrent shard requests (Default = 5)
     * $params['rest_total_hits_as_int']        = (boolean) Indicates whether hits.total should be rendered as an integer or an object in the rest search response (Default = false)
     * $params['ccs_minimize_roundtrips']       = (boolean) Indicates whether network round-trips should be minimized as part of cross-cluster search requests execution (Default = true)
     * $params['body']                          = (array) The request definitions (metadata-search request definition pairs), separated by newlines (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-multi-search.html
     */
    public function msearch(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Msearch $endpoint */
        $endpoint = $endpointBuilder('Msearch');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to execute several search template operations in one request.
     *
     * $params['index']                   = (list) A comma-separated list of index names to use as default
     * $params['type']                    = DEPRECATED (list) A comma-separated list of document types to use as default
     * $params['search_type']             = (enum) Search operation type (Options = query_then_fetch,dfs_query_then_fetch)
     * $params['typed_keys']              = (boolean) Specify whether aggregation and suggester names should be prefixed by their respective types in the response
     * $params['max_concurrent_searches'] = (number) Controls the maximum number of concurrent searches the multi search api will execute
     * $params['rest_total_hits_as_int']  = (boolean) Indicates whether hits.total should be rendered as an integer or an object in the rest search response (Default = false)
     * $params['ccs_minimize_roundtrips'] = (boolean) Indicates whether network round-trips should be minimized as part of cross-cluster search requests execution (Default = true)
     * $params['body']                    = (array) The request definitions (metadata-search request definition pairs), separated by newlines (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-multi-search.html
     */
    public function msearchTemplate(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\MsearchTemplate $endpoint */
        $endpoint = $endpointBuilder('MsearchTemplate');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns multiple termvectors in one request.
     *
     * $params['index']            = (string) The index in which the document resides.
     * $params['type']             = DEPRECATED (string) The type of the document.
     * $params['ids']              = (list) A comma-separated list of documents ids. You must define ids as parameter or set "ids" or "docs" in the request body
     * $params['term_statistics']  = (boolean) Specifies if total term frequency and document frequency should be returned. Applies to all returned documents unless otherwise specified in body "params" or "docs". (Default = false)
     * $params['field_statistics'] = (boolean) Specifies if document count, sum of document frequencies and sum of total term frequencies should be returned. Applies to all returned documents unless otherwise specified in body "params" or "docs". (Default = true)
     * $params['fields']           = (list) A comma-separated list of fields to return. Applies to all returned documents unless otherwise specified in body "params" or "docs".
     * $params['offsets']          = (boolean) Specifies if term offsets should be returned. Applies to all returned documents unless otherwise specified in body "params" or "docs". (Default = true)
     * $params['positions']        = (boolean) Specifies if term positions should be returned. Applies to all returned documents unless otherwise specified in body "params" or "docs". (Default = true)
     * $params['payloads']         = (boolean) Specifies if term payloads should be returned. Applies to all returned documents unless otherwise specified in body "params" or "docs". (Default = true)
     * $params['preference']       = (string) Specify the node or shard the operation should be performed on (default: random) .Applies to all returned documents unless otherwise specified in body "params" or "docs".
     * $params['routing']          = (string) Specific routing value. Applies to all returned documents unless otherwise specified in body "params" or "docs".
     * $params['realtime']         = (boolean) Specifies if requests are real-time as opposed to near-real-time (default: true).
     * $params['version']          = (number) Explicit version number for concurrency control
     * $params['version_type']     = (enum) Specific version type (Options = internal,external,external_gte,force)
     * $params['body']             = (array) Define ids, documents, parameters or a list of parameters per document here. You must at least provide a list of document ids. See documentation.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-multi-termvectors.html
     */
    public function mtermvectors(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\MTermVectors $endpoint */
        $endpoint = $endpointBuilder('MTermVectors');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Open a point in time that can be used in subsequent searches
     *
     * $params['index']              = (list) A comma-separated list of index names to open point in time; use `_all` or empty string to perform the operation on all indices
     * $params['preference']         = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['routing']            = (string) Specific routing value
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['keep_alive']         = (string) Specific the time to live for the point in time (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/point-in-time-api.html
     */
    public function openPointInTime(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\OpenPointInTime $endpoint */
        $endpoint = $endpointBuilder('OpenPointInTime');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns whether the cluster is running.
     *
     * @param array $params Associative array of parameters
     * @return bool
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html
     */
    public function ping(array $params = []): bool
    {
        // manually make this verbose so we can check status code
        $params['client']['verbose'] = true;

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Ping $endpoint */
        $endpoint = $endpointBuilder('Ping');
        $endpoint->setParams($params);

        return BooleanRequestWrapper::performRequest($endpoint, $this->transport);
    }

    /**
     * Creates or updates a script.
     *
     * $params['id']             = (string) Script ID (Required)
     * $params['context']        = (string) Script context
     * $params['timeout']        = (time) Explicit operation timeout
     * $params['master_timeout'] = (time) Specify timeout for connection to master
     * $params['body']           = (array) The document (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-scripting.html
     */
    public function putScript(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $context = $this->extractArgument($params, 'context');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\PutScript $endpoint */
        $endpoint = $endpointBuilder('PutScript');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setContext($context);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to evaluate the quality of ranked search results over a set of typical search queries
     *
     * $params['index']              = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['search_type']        = (enum) Search operation type (Options = query_then_fetch,dfs_query_then_fetch)
     * $params['body']               = (array) The ranking evaluation search definition, including search requests, document ratings and ranking metric definition. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-rank-eval.html
     */
    public function rankEval(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\RankEval $endpoint */
        $endpoint = $endpointBuilder('RankEval');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to copy documents from one index to another, optionally filtering the sourcedocuments by a query, changing the destination index settings, or fetching thedocuments from a remote cluster.
     *
     * $params['refresh']                = (boolean) Should the affected indexes be refreshed?
     * $params['timeout']                = (time) Time each individual bulk request should wait for shards that are unavailable. (Default = 1m)
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the reindex operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['wait_for_completion']    = (boolean) Should the request should block until the reindex is complete. (Default = true)
     * $params['requests_per_second']    = (number) The throttle to set on this request in sub-requests per second. -1 means no throttle. (Default = 0)
     * $params['scroll']                 = (time) Control how long to keep the search context alive (Default = 5m)
     * $params['slices']                 = (number|string) The number of slices this task should be divided into. Defaults to 1, meaning the task isn't sliced into subtasks. Can be set to `auto`. (Default = 1)
     * $params['max_docs']               = (number) Maximum number of documents to process (default: all documents)
     * $params['body']                   = (array) The search definition using the Query DSL and the prototype for the index request. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-reindex.html
     */
    public function reindex(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Reindex $endpoint */
        $endpoint = $endpointBuilder('Reindex');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Changes the number of requests per second for a particular Reindex operation.
     *
     * $params['task_id']             = (string) The task id to rethrottle
     * $params['requests_per_second'] = (number) The throttle to set on this request in floating sub-requests per second. -1 means set no throttle. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-reindex.html
     */
    public function reindexRethrottle(array $params = [])
    {
        $task_id = $this->extractArgument($params, 'task_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\ReindexRethrottle $endpoint */
        $endpoint = $endpointBuilder('ReindexRethrottle');
        $endpoint->setParams($params);
        $endpoint->setTaskId($task_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to use the Mustache language to pre-render a search definition.
     *
     * $params['id']   = (string) The id of the stored search template
     * $params['body'] = (array) The search definition template and its params
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/render-search-template-api.html
     */
    public function renderSearchTemplate(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\RenderSearchTemplate $endpoint */
        $endpoint = $endpointBuilder('RenderSearchTemplate');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows an arbitrary script to be executed and a result to be returned
     *
     * $params['body'] = (array) The script to execute
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/painless/master/painless-execute-api.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function scriptsPainlessExecute(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\ScriptsPainlessExecute $endpoint */
        $endpoint = $endpointBuilder('ScriptsPainlessExecute');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to retrieve a large numbers of results from a single search request.
     *
     * $params['scroll_id']              = DEPRECATED (string) The scroll ID
     * $params['scroll']                 = (time) Specify how long a consistent view of the index should be maintained for scrolled search
     * $params['rest_total_hits_as_int'] = (boolean) Indicates whether hits.total should be rendered as an integer or an object in the rest search response (Default = false)
     * $params['body']                   = (array) The scroll ID if not passed by URL or query parameter.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-request-body.html#request-body-search-scroll
     */
    public function scroll(array $params = [])
    {
        $scroll_id = $this->extractArgument($params, 'scroll_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Scroll $endpoint */
        $endpoint = $endpointBuilder('Scroll');
        $endpoint->setParams($params);
        $endpoint->setScrollId($scroll_id);
        $endpoint->setBody($body);

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
     * Searches a vector tile for geospatial values. Returns results as a binary Mapbox vector tile.
     *
     * $params['index']            = (list) Comma-separated list of data streams, indices, or aliases to search
     * $params['field']            = (string) Field containing geospatial data to return
     * $params['zoom']             = (int) Zoom level for the vector tile to search
     * $params['x']                = (int) X coordinate for the vector tile to search
     * $params['y']                = (int) Y coordinate for the vector tile to search
     * $params['exact_bounds']     = (boolean) If false, the meta layer's feature is the bounding box of the tile. If true, the meta layer's feature is a bounding box resulting from a `geo_bounds` aggregation. (Default = false)
     * $params['extent']           = (int) Size, in pixels, of a side of the vector tile. (Default = 4096)
     * $params['grid_precision']   = (int) Additional zoom levels available through the aggs layer. Accepts 0-8. (Default = 8)
     * $params['grid_type']        = (enum) Determines the geometry type for features in the aggs layer. (Options = grid,point,centroid) (Default = grid)
     * $params['size']             = (int) Maximum number of features to return in the hits layer. Accepts 0-10000. (Default = 10000)
     * $params['track_total_hits'] = (boolean|long) Indicate if the number of documents that match the query should be tracked. A number can also be specified, to accurately track the total hit count up to the number.
     * $params['body']             = (array) Search request body.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-vector-tile-api.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function searchMvt(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $field = $this->extractArgument($params, 'field');
        $zoom = $this->extractArgument($params, 'zoom');
        $x = $this->extractArgument($params, 'x');
        $y = $this->extractArgument($params, 'y');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\SearchMvt $endpoint */
        $endpoint = $endpointBuilder('SearchMvt');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setField($field);
        $endpoint->setZoom($zoom);
        $endpoint->setX($x);
        $endpoint->setY($y);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about the indices and shards that a search request would be executed against.
     *
     * $params['index']              = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices
     * $params['preference']         = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['routing']            = (string) Specific routing value
     * $params['local']              = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['ignore_unavailable'] = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']   = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']   = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/search-shards.html
     */
    public function searchShards(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\SearchShards $endpoint */
        $endpoint = $endpointBuilder('SearchShards');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to use the Mustache language to pre-render a search definition.
     *
     * $params['index']                   = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices
     * $params['type']                    = DEPRECATED (list) A comma-separated list of document types to search; leave empty to perform the operation on all types
     * $params['ignore_unavailable']      = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['ignore_throttled']        = (boolean) Whether specified concrete, expanded or aliased indices should be ignored when throttled
     * $params['allow_no_indices']        = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['expand_wildcards']        = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['preference']              = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['routing']                 = (list) A comma-separated list of specific routing values
     * $params['scroll']                  = (time) Specify how long a consistent view of the index should be maintained for scrolled search
     * $params['search_type']             = (enum) Search operation type (Options = query_then_fetch,dfs_query_then_fetch)
     * $params['explain']                 = (boolean) Specify whether to return detailed information about score computation as part of a hit
     * $params['profile']                 = (boolean) Specify whether to profile the query execution
     * $params['typed_keys']              = (boolean) Specify whether aggregation and suggester names should be prefixed by their respective types in the response
     * $params['rest_total_hits_as_int']  = (boolean) Indicates whether hits.total should be rendered as an integer or an object in the rest search response (Default = false)
     * $params['ccs_minimize_roundtrips'] = (boolean) Indicates whether network round-trips should be minimized as part of cross-cluster search requests execution (Default = true)
     * $params['body']                    = (array) The search definition template and its params (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-template.html
     */
    public function searchTemplate(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\SearchTemplate $endpoint */
        $endpoint = $endpointBuilder('SearchTemplate');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * The terms enum API  can be used to discover terms in the index that begin with the provided string. It is designed for low-latency look-ups used in auto-complete scenarios.
     *
     * $params['index'] = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices
     * $params['body']  = (array) field name, string which is the prefix expected in matching terms, timeout and size for max number of results
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-terms-enum.html
     */
    public function termsEnum(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\TermsEnum $endpoint */
        $endpoint = $endpointBuilder('TermsEnum');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information and statistics about terms in the fields of a particular document.
     *
     * $params['index']            = (string) The index in which the document resides. (Required)
     * $params['id']               = (string) The id of the document, when not specified a doc param should be supplied.
     * $params['type']             = DEPRECATED (string) The type of the document.
     * $params['term_statistics']  = (boolean) Specifies if total term frequency and document frequency should be returned. (Default = false)
     * $params['field_statistics'] = (boolean) Specifies if document count, sum of document frequencies and sum of total term frequencies should be returned. (Default = true)
     * $params['fields']           = (list) A comma-separated list of fields to return.
     * $params['offsets']          = (boolean) Specifies if term offsets should be returned. (Default = true)
     * $params['positions']        = (boolean) Specifies if term positions should be returned. (Default = true)
     * $params['payloads']         = (boolean) Specifies if term payloads should be returned. (Default = true)
     * $params['preference']       = (string) Specify the node or shard the operation should be performed on (default: random).
     * $params['routing']          = (string) Specific routing value.
     * $params['realtime']         = (boolean) Specifies if request is real-time as opposed to near-real-time (default: true).
     * $params['version']          = (number) Explicit version number for concurrency control
     * $params['version_type']     = (enum) Specific version type (Options = internal,external,external_gte,force)
     * $params['body']             = (array) Define parameters and or supply a document to get termvectors for. See documentation.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-termvectors.html
     */
    public function termvectors(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $id = $this->extractArgument($params, 'id');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\TermVectors $endpoint */
        $endpoint = $endpointBuilder('TermVectors');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setId($id);
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
     * Performs an update on every document in the index without changing the source,for example to pick up a mapping change.
     *
     * $params['index']                  = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices (Required)
     * $params['type']                   = DEPRECATED (list) A comma-separated list of document types to search; leave empty to perform the operation on all types
     * $params['analyzer']               = (string) The analyzer to use for the query string
     * $params['analyze_wildcard']       = (boolean) Specify whether wildcard and prefix queries should be analyzed (default: false)
     * $params['default_operator']       = (enum) The default operator for query string query (AND or OR) (Options = AND,OR) (Default = OR)
     * $params['df']                     = (string) The field to use as default where no field prefix is given in the query string
     * $params['from']                   = (number) Starting offset (default: 0)
     * $params['ignore_unavailable']     = (boolean) Whether specified concrete indices should be ignored when unavailable (missing or closed)
     * $params['allow_no_indices']       = (boolean) Whether to ignore if a wildcard indices expression resolves into no concrete indices. (This includes `_all` string or when no indices have been specified)
     * $params['conflicts']              = (enum) What to do when the update by query hits version conflicts? (Options = abort,proceed) (Default = abort)
     * $params['expand_wildcards']       = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = open)
     * $params['lenient']                = (boolean) Specify whether format-based query failures (such as providing text to a numeric field) should be ignored
     * $params['pipeline']               = (string) Ingest pipeline to set on index requests made by this action. (default: none)
     * $params['preference']             = (string) Specify the node or shard the operation should be performed on (default: random)
     * $params['q']                      = (string) Query in the Lucene query string syntax
     * $params['routing']                = (list) A comma-separated list of specific routing values
     * $params['scroll']                 = (time) Specify how long a consistent view of the index should be maintained for scrolled search
     * $params['search_type']            = (enum) Search operation type (Options = query_then_fetch,dfs_query_then_fetch)
     * $params['search_timeout']         = (time) Explicit timeout for each search request. Defaults to no timeout.
     * $params['size']                   = (number) Deprecated, please use `max_docs` instead
     * $params['max_docs']               = (number) Maximum number of documents to process (default: all documents)
     * $params['sort']                   = (list) A comma-separated list of <field>:<direction> pairs
     * $params['terminate_after']        = (number) The maximum number of documents to collect for each shard, upon reaching which the query execution will terminate early.
     * $params['stats']                  = (list) Specific 'tag' of the request for logging and statistical purposes
     * $params['version']                = (boolean) Specify whether to return document version as part of a hit
     * $params['version_type']           = (boolean) Should the document increment the version number (internal) on hit or not (reindex)
     * $params['request_cache']          = (boolean) Specify if request cache should be used for this request or not, defaults to index level setting
     * $params['refresh']                = (boolean) Should the affected indexes be refreshed?
     * $params['timeout']                = (time) Time each individual bulk request should wait for shards that are unavailable. (Default = 1m)
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before proceeding with the update by query operation. Defaults to 1, meaning the primary shard only. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1)
     * $params['scroll_size']            = (number) Size on the scroll request powering the update by query (Default = 100)
     * $params['wait_for_completion']    = (boolean) Should the request should block until the update by query operation is complete. (Default = true)
     * $params['requests_per_second']    = (number) The throttle to set on this request in sub-requests per second. -1 means no throttle. (Default = 0)
     * $params['slices']                 = (number|string) The number of slices this task should be divided into. Defaults to 1, meaning the task isn't sliced into subtasks. Can be set to `auto`. (Default = 1)
     * $params['body']                   = (array) The search definition using the Query DSL
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/docs-update-by-query.html
     */
    public function updateByQuery(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\UpdateByQuery $endpoint */
        $endpoint = $endpointBuilder('UpdateByQuery');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Changes the number of requests per second for a particular Update By Query operation.
     *
     * $params['task_id']             = (string) The task id to rethrottle
     * $params['requests_per_second'] = (number) The throttle to set on this request in floating sub-requests per second. -1 means set no throttle. (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @throws Common\Exceptions\NoNodesAvailableException
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-update-by-query.html
     */
    public function updateByQueryRethrottle(array $params = [])
    {
        $task_id = $this->extractArgument($params, 'task_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\UpdateByQueryRethrottle $endpoint */
        $endpoint = $endpointBuilder('UpdateByQueryRethrottle');
        $endpoint->setParams($params);
        $endpoint->setTaskId($task_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the asyncSearch namespace
     */
    public function asyncSearch(): AsyncSearchNamespace
    {
        return $this->asyncSearch;
    }

    /**
     * Returns the autoscaling namespace
     */
    public function autoscaling(): AutoscalingNamespace
    {
        return $this->autoscaling;
    }

    /**
     * Returns the cat namespace
     */
    public function cat(): CatNamespace
    {
        return $this->cat;
    }

    /**
     * Returns the ccr namespace
     */
    public function ccr(): CcrNamespace
    {
        return $this->ccr;
    }

    /**
     * Returns the cluster namespace
     */
    public function cluster(): ClusterNamespace
    {
        return $this->cluster;
    }

    /**
     * Returns the danglingIndices namespace
     */
    public function danglingIndices(): DanglingIndicesNamespace
    {
        return $this->danglingIndices;
    }

    /**
     * Returns the dataFrameTransformDeprecated namespace
     */
    public function dataFrameTransformDeprecated(): DataFrameTransformDeprecatedNamespace
    {
        return $this->dataFrameTransformDeprecated;
    }

    /**
     * Returns the enrich namespace
     */
    public function enrich(): EnrichNamespace
    {
        return $this->enrich;
    }

    /**
     * Returns the eql namespace
     */
    public function eql(): EqlNamespace
    {
        return $this->eql;
    }

    /**
     * Returns the features namespace
     */
    public function features(): FeaturesNamespace
    {
        return $this->features;
    }

    /**
     * Returns the fleet namespace
     */
    public function fleet(): FleetNamespace
    {
        return $this->fleet;
    }

    /**
     * Returns the graph namespace
     */
    public function graph(): GraphNamespace
    {
        return $this->graph;
    }

    /**
     * Returns the ilm namespace
     */
    public function ilm(): IlmNamespace
    {
        return $this->ilm;
    }

    /**
     * Returns the indices namespace
     */
    public function indices(): IndicesNamespace
    {
        return $this->indices;
    }

    /**
     * Returns the ingest namespace
     */
    public function ingest(): IngestNamespace
    {
        return $this->ingest;
    }

    /**
     * Returns the license namespace
     */
    public function license(): LicenseNamespace
    {
        return $this->license;
    }

    /**
     * Returns the logstash namespace
     */
    public function logstash(): LogstashNamespace
    {
        return $this->logstash;
    }

    /**
     * Returns the migration namespace
     */
    public function migration(): MigrationNamespace
    {
        return $this->migration;
    }

    /**
     * Returns the ml namespace
     */
    public function ml(): MlNamespace
    {
        return $this->ml;
    }

    /**
     * Returns the monitoring namespace
     */
    public function monitoring(): MonitoringNamespace
    {
        return $this->monitoring;
    }

    /**
     * Returns the nodes namespace
     */
    public function nodes(): NodesNamespace
    {
        return $this->nodes;
    }

    /**
     * Returns the rollup namespace
     */
    public function rollup(): RollupNamespace
    {
        return $this->rollup;
    }

    /**
     * Returns the searchableSnapshots namespace
     */
    public function searchableSnapshots(): SearchableSnapshotsNamespace
    {
        return $this->searchableSnapshots;
    }

    /**
     * Returns the security namespace
     */
    public function security(): SecurityNamespace
    {
        return $this->security;
    }

    /**
     * Returns the shutdown namespace
     */
    public function shutdown(): ShutdownNamespace
    {
        return $this->shutdown;
    }

    /**
     * Returns the slm namespace
     */
    public function slm(): SlmNamespace
    {
        return $this->slm;
    }

    /**
     * Returns the snapshot namespace
     */
    public function snapshot(): SnapshotNamespace
    {
        return $this->snapshot;
    }

    /**
     * Returns the sql namespace
     */
    public function sql(): SqlNamespace
    {
        return $this->sql;
    }

    /**
     * Returns the ssl namespace
     */
    public function ssl(): SslNamespace
    {
        return $this->ssl;
    }

    /**
     * Returns the tasks namespace
     */
    public function tasks(): TasksNamespace
    {
        return $this->tasks;
    }

    /**
     * Returns the textStructure namespace
     */
    public function textStructure(): TextStructureNamespace
    {
        return $this->textStructure;
    }

    /**
     * Returns the transform namespace
     */
    public function transform(): TransformNamespace
    {
        return $this->transform;
    }

    /**
     * Returns the watcher namespace
     */
    public function watcher(): WatcherNamespace
    {
        return $this->watcher;
    }

    /**
     * Returns the xpack namespace
     */
    public function xpack(): XpackNamespace
    {
        return $this->xpack;
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
