<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:42:31
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints;

/**
 * Class CatNamespace
 */
class CatNamespace extends AbstractNamespace
{
    /**
     * Shows information about currently configured aliases to indices including filter and routing infos.
     *
     * $params['name']             = (list) A comma-separated list of alias names to return
     * $params['format']           = (string) a short version of the Accept header, e.g. json, yaml
     * $params['local']            = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['h']                = (list) Comma-separated list of column names to display
     * $params['help']             = (boolean) Return help information (Default = false)
     * $params['s']                = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']                = (boolean) Verbose mode. Display column headers (Default = false)
     * $params['expand_wildcards'] = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = all)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-alias.html
     */
    public function aliases(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Aliases $endpoint */
        $endpoint = $endpointBuilder('Cat\Aliases');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Provides a snapshot of how many shards are allocated to each data node and how much disk space they are using.
     *
     * $params['node_id']        = (list) A comma-separated list of node IDs or names to limit the returned information
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['bytes']          = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-allocation.html
     */
    public function allocation(array $params = [])
    {
        $node_id = $this->extractArgument($params, 'node_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Allocation $endpoint */
        $endpoint = $endpointBuilder('Cat\Allocation');
        $endpoint->setParams($params);
        $endpoint->setNodeId($node_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Provides quick access to the document count of the entire cluster, or individual indices.
     *
     * $params['index']  = (list) A comma-separated list of index names to limit the returned information
     * $params['format'] = (string) a short version of the Accept header, e.g. json, yaml
     * $params['h']      = (list) Comma-separated list of column names to display
     * $params['help']   = (boolean) Return help information (Default = false)
     * $params['s']      = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']      = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-count.html
     */
    public function count(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Count $endpoint */
        $endpoint = $endpointBuilder('Cat\Count');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Shows how much heap memory is currently being used by fielddata on every data node in the cluster.
     *
     * $params['fields'] = (list) A comma-separated list of fields to return the fielddata size
     * $params['format'] = (string) a short version of the Accept header, e.g. json, yaml
     * $params['bytes']  = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['h']      = (list) Comma-separated list of column names to display
     * $params['help']   = (boolean) Return help information (Default = false)
     * $params['s']      = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']      = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-fielddata.html
     */
    public function fielddata(array $params = [])
    {
        $fields = $this->extractArgument($params, 'fields');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Fielddata $endpoint */
        $endpoint = $endpointBuilder('Cat\Fielddata');
        $endpoint->setParams($params);
        $endpoint->setFields($fields);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns a concise representation of the cluster health.
     *
     * $params['format'] = (string) a short version of the Accept header, e.g. json, yaml
     * $params['h']      = (list) Comma-separated list of column names to display
     * $params['help']   = (boolean) Return help information (Default = false)
     * $params['s']      = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']   = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['ts']     = (boolean) Set to false to disable timestamping (Default = true)
     * $params['v']      = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-health.html
     */
    public function health(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Health $endpoint */
        $endpoint = $endpointBuilder('Cat\Health');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns help for the Cat APIs.
     *
     * $params['help'] = (boolean) Return help information (Default = false)
     * $params['s']    = (list) Comma-separated list of column names or column aliases to sort by
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat.html
     */
    public function help(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Help $endpoint */
        $endpoint = $endpointBuilder('Cat\Help');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about indices: number of primaries and replicas, document counts, disk size, ...
     *
     * $params['index']                     = (list) A comma-separated list of index names to limit the returned information
     * $params['format']                    = (string) a short version of the Accept header, e.g. json, yaml
     * $params['bytes']                     = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['local']                     = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout']            = (time) Explicit operation timeout for connection to master node
     * $params['h']                         = (list) Comma-separated list of column names to display
     * $params['health']                    = (enum) A health status ("green", "yellow", or "red" to filter only indices matching the specified health status (Options = green,yellow,red)
     * $params['help']                      = (boolean) Return help information (Default = false)
     * $params['pri']                       = (boolean) Set to true to return stats only for primary shards (Default = false)
     * $params['s']                         = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']                      = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']                         = (boolean) Verbose mode. Display column headers (Default = false)
     * $params['include_unloaded_segments'] = (boolean) If set to true segment stats will include stats for segments that are not currently loaded into memory (Default = false)
     * $params['expand_wildcards']          = (enum) Whether to expand wildcard expression to concrete indices that are open, closed or both. (Options = open,closed,hidden,none,all) (Default = all)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-indices.html
     */
    public function indices(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Indices $endpoint */
        $endpoint = $endpointBuilder('Cat\Indices');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about the master node.
     *
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-master.html
     */
    public function master(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Master $endpoint */
        $endpoint = $endpointBuilder('Cat\Master');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets configuration and usage information about data frame analytics jobs.
     *
     * $params['id']             = (string) The ID of the data frame analytics to fetch
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no configs. (This includes `_all` string or when no configs have been specified)
     * $params['bytes']          = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']           = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see http://www.elastic.co/guide/en/elasticsearch/reference/current/cat-dfanalytics.html
     */
    public function mlDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\MlDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Cat\MlDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets configuration and usage information about datafeeds.
     *
     * $params['datafeed_id']        = (string) The ID of the datafeeds stats to fetch
     * $params['allow_no_match']     = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     * $params['allow_no_datafeeds'] = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     * $params['format']             = (string) a short version of the Accept header, e.g. json, yaml
     * $params['h']                  = (list) Comma-separated list of column names to display
     * $params['help']               = (boolean) Return help information (Default = false)
     * $params['s']                  = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']               = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']                  = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see http://www.elastic.co/guide/en/elasticsearch/reference/current/cat-datafeeds.html
     */
    public function mlDatafeeds(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\MlDatafeeds $endpoint */
        $endpoint = $endpointBuilder('Cat\MlDatafeeds');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets configuration and usage information about anomaly detection jobs.
     *
     * $params['job_id']         = (string) The ID of the jobs stats to fetch
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['allow_no_jobs']  = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['bytes']          = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']           = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see http://www.elastic.co/guide/en/elasticsearch/reference/current/cat-anomaly-detectors.html
     */
    public function mlJobs(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\MlJobs $endpoint */
        $endpoint = $endpointBuilder('Cat\MlJobs');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets configuration and usage information about inference trained models.
     *
     * $params['model_id']       = (string) The ID of the trained models stats to fetch
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no trained models. (This includes `_all` string or when no trained models have been specified) (Default = true)
     * $params['from']           = (int) skips a number of trained models (Default = 0)
     * $params['size']           = (int) specifies a max number of trained models to get (Default = 100)
     * $params['bytes']          = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']           = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/cat-trained-model.html
     */
    public function mlTrainedModels(array $params = [])
    {
        $model_id = $this->extractArgument($params, 'model_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\MlTrainedModels $endpoint */
        $endpoint = $endpointBuilder('Cat\MlTrainedModels');
        $endpoint->setParams($params);
        $endpoint->setModelId($model_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about custom node attributes.
     *
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-nodeattrs.html
     */
    public function nodeattrs(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\NodeAttrs $endpoint */
        $endpoint = $endpointBuilder('Cat\NodeAttrs');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns basic statistics about performance of cluster nodes.
     *
     * $params['bytes']                     = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['format']                    = (string) a short version of the Accept header, e.g. json, yaml
     * $params['full_id']                   = (boolean) Return the full node ID instead of the shortened version (default: false)
     * $params['local']                     = (boolean) Calculate the selected nodes using the local cluster state rather than the state from master node (default: false)
     * $params['master_timeout']            = (time) Explicit operation timeout for connection to master node
     * $params['h']                         = (list) Comma-separated list of column names to display
     * $params['help']                      = (boolean) Return help information (Default = false)
     * $params['s']                         = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']                      = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']                         = (boolean) Verbose mode. Display column headers (Default = false)
     * $params['include_unloaded_segments'] = (boolean) If set to true segment stats will include stats for segments that are not currently loaded into memory (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-nodes.html
     */
    public function nodes(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Nodes $endpoint */
        $endpoint = $endpointBuilder('Cat\Nodes');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns a concise representation of the cluster pending tasks.
     *
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']           = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-pending-tasks.html
     */
    public function pendingTasks(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\PendingTasks $endpoint */
        $endpoint = $endpointBuilder('Cat\PendingTasks');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about installed plugins across nodes node.
     *
     * $params['format']            = (string) a short version of the Accept header, e.g. json, yaml
     * $params['local']             = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout']    = (time) Explicit operation timeout for connection to master node
     * $params['h']                 = (list) Comma-separated list of column names to display
     * $params['help']              = (boolean) Return help information (Default = false)
     * $params['include_bootstrap'] = (boolean) Include bootstrap plugins in the response (Default = false)
     * $params['s']                 = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']                 = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-plugins.html
     */
    public function plugins(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Plugins $endpoint */
        $endpoint = $endpointBuilder('Cat\Plugins');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about index shard recoveries, both on-going completed.
     *
     * $params['index']       = (list) Comma-separated list or wildcard expression of index names to limit the returned information
     * $params['format']      = (string) a short version of the Accept header, e.g. json, yaml
     * $params['active_only'] = (boolean) If `true`, the response only includes ongoing shard recoveries (Default = false)
     * $params['bytes']       = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['detailed']    = (boolean) If `true`, the response includes detailed information about shard recoveries (Default = false)
     * $params['h']           = (list) Comma-separated list of column names to display
     * $params['help']        = (boolean) Return help information (Default = false)
     * $params['s']           = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']        = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']           = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-recovery.html
     */
    public function recovery(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Recovery $endpoint */
        $endpoint = $endpointBuilder('Cat\Recovery');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about snapshot repositories registered in the cluster.
     *
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (Default = false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-repositories.html
     */
    public function repositories(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Repositories $endpoint */
        $endpoint = $endpointBuilder('Cat\Repositories');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Provides low-level information about the segments in the shards of an index.
     *
     * $params['index']  = (list) A comma-separated list of index names to limit the returned information
     * $params['format'] = (string) a short version of the Accept header, e.g. json, yaml
     * $params['bytes']  = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['h']      = (list) Comma-separated list of column names to display
     * $params['help']   = (boolean) Return help information (Default = false)
     * $params['s']      = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']      = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-segments.html
     */
    public function segments(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Segments $endpoint */
        $endpoint = $endpointBuilder('Cat\Segments');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Provides a detailed view of shard allocation on nodes.
     *
     * $params['index']          = (list) A comma-separated list of index names to limit the returned information
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['bytes']          = (enum) The unit in which to display byte values (Options = b,k,kb,m,mb,g,gb,t,tb,p,pb)
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']           = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-shards.html
     */
    public function shards(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Shards $endpoint */
        $endpoint = $endpointBuilder('Cat\Shards');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns all snapshots in a specific repository.
     *
     * $params['repository']         = (list) Name of repository from which to fetch the snapshot information
     * $params['format']             = (string) a short version of the Accept header, e.g. json, yaml
     * $params['ignore_unavailable'] = (boolean) Set to true to ignore unavailable snapshots (Default = false)
     * $params['master_timeout']     = (time) Explicit operation timeout for connection to master node
     * $params['h']                  = (list) Comma-separated list of column names to display
     * $params['help']               = (boolean) Return help information (Default = false)
     * $params['s']                  = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']               = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']                  = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-snapshots.html
     */
    public function snapshots(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Snapshots $endpoint */
        $endpoint = $endpointBuilder('Cat\Snapshots');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about the tasks currently executing on one or more nodes in the cluster.
     *
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['nodes']          = (list) A comma-separated list of node IDs or names to limit the returned information; use `_local` to return information from the node you're connecting to, leave empty to get information from all nodes
     * $params['actions']        = (list) A comma-separated list of actions that should be returned. Leave empty to return all.
     * $params['detailed']       = (boolean) Return detailed task information (default: false)
     * $params['parent_task_id'] = (string) Return tasks with specified parent task id (node_id:task_number). Set to -1 to return all.
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']           = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/tasks.html
     */
    public function tasks(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Tasks $endpoint */
        $endpoint = $endpointBuilder('Cat\Tasks');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about existing templates.
     *
     * $params['name']           = (string) A pattern that returned template names must match
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-templates.html
     */
    public function templates(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Templates $endpoint */
        $endpoint = $endpointBuilder('Cat\Templates');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns cluster-wide thread pool statistics per node.By default the active, queue and rejected statistics are returned for all thread pools.
     *
     * $params['thread_pool_patterns'] = (list) A comma-separated list of regular-expressions to filter the thread pools in the output
     * $params['format']               = (string) a short version of the Accept header, e.g. json, yaml
     * $params['size']                 = (enum) The multiplier in which to display values (Options = ,k,m,g,t,p)
     * $params['local']                = (boolean) Return local information, do not retrieve the state from master node (default: false)
     * $params['master_timeout']       = (time) Explicit operation timeout for connection to master node
     * $params['h']                    = (list) Comma-separated list of column names to display
     * $params['help']                 = (boolean) Return help information (Default = false)
     * $params['s']                    = (list) Comma-separated list of column names or column aliases to sort by
     * $params['v']                    = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/cat-thread-pool.html
     */
    public function threadPool(array $params = [])
    {
        $thread_pool_patterns = $this->extractArgument($params, 'thread_pool_patterns');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\ThreadPool $endpoint */
        $endpoint = $endpointBuilder('Cat\ThreadPool');
        $endpoint->setParams($params);
        $endpoint->setThreadPoolPatterns($thread_pool_patterns);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets configuration and usage information about transforms.
     *
     * $params['transform_id']   = (string) The id of the transform for which to get stats. '_all' or '*' implies all transforms
     * $params['from']           = (int) skips a number of transform configs, defaults to 0
     * $params['size']           = (int) specifies a max number of transforms to get, defaults to 100
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no transforms. (This includes `_all` string or when no transforms have been specified)
     * $params['format']         = (string) a short version of the Accept header, e.g. json, yaml
     * $params['h']              = (list) Comma-separated list of column names to display
     * $params['help']           = (boolean) Return help information (Default = false)
     * $params['s']              = (list) Comma-separated list of column names or column aliases to sort by
     * $params['time']           = (enum) The unit in which to display time values (Options = d,h,m,s,ms,micros,nanos)
     * $params['v']              = (boolean) Verbose mode. Display column headers (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/cat-transforms.html
     */
    public function transforms(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Cat\Transforms $endpoint */
        $endpoint = $endpointBuilder('Cat\Transforms');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }
}