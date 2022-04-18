<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:27:04
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Snapshot;

/**
 * Class SnapshotNamespace
 */
class SnapshotNamespace extends AbstractNamespace
{
    /**
     * Removes stale data from repository.
     *
     * $params['repository']     = (string) A repository name
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['timeout']        = (time) Explicit operation timeout
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/clean-up-snapshot-repo-api.html
     */
    public function cleanupRepository(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\CleanupRepository $endpoint */
        $endpoint = $endpointBuilder('Snapshot\CleanupRepository');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);

        return $this->performRequest($endpoint);
    }

    /**
     * Clones indices from one snapshot into another snapshot in the same repository.
     *
     * $params['repository']      = (string) A repository name
     * $params['snapshot']        = (string) The name of the snapshot to clone from
     * $params['target_snapshot'] = (string) The name of the cloned snapshot to create
     * $params['master_timeout']  = (time) Explicit operation timeout for connection to master node
     * $params['body']            = (array) The snapshot clone definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function clone(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $snapshot = $this->extractArgument($params, 'snapshot');
        $target_snapshot = $this->extractArgument($params, 'target_snapshot');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\CloneSnapshot $endpoint */
        $endpoint = $endpointBuilder('Snapshot\CloneSnapshot');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setSnapshot($snapshot);
        $endpoint->setTargetSnapshot($target_snapshot);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a snapshot in a repository.
     *
     * $params['repository']          = (string) A repository name
     * $params['snapshot']            = (string) A snapshot name
     * $params['master_timeout']      = (time) Explicit operation timeout for connection to master node
     * $params['wait_for_completion'] = (boolean) Should this request wait until the operation has completed before returning (Default = false)
     * $params['body']                = (array) The snapshot definition
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function create(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $snapshot = $this->extractArgument($params, 'snapshot');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\Create $endpoint */
        $endpoint = $endpointBuilder('Snapshot\Create');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setSnapshot($snapshot);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a repository.
     *
     * $params['repository']     = (string) A repository name
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['timeout']        = (time) Explicit operation timeout
     * $params['verify']         = (boolean) Whether to verify the repository after creation
     * $params['body']           = (array) The repository definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function createRepository(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\CreateRepository $endpoint */
        $endpoint = $endpointBuilder('Snapshot\CreateRepository');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes a snapshot.
     *
     * $params['repository']     = (string) A repository name
     * $params['snapshot']       = (string) A snapshot name
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function delete(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $snapshot = $this->extractArgument($params, 'snapshot');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\Delete $endpoint */
        $endpoint = $endpointBuilder('Snapshot\Delete');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setSnapshot($snapshot);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes a repository.
     *
     * $params['repository']     = (list) Name of the snapshot repository to unregister. Wildcard (`*`) patterns are supported.
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['timeout']        = (time) Explicit operation timeout
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function deleteRepository(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\DeleteRepository $endpoint */
        $endpoint = $endpointBuilder('Snapshot\DeleteRepository');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about a snapshot.
     *
     * $params['repository']         = (string) A repository name
     * $params['snapshot']           = (list) A comma-separated list of snapshot names
     * $params['master_timeout']     = (time) Explicit operation timeout for connection to master node
     * $params['ignore_unavailable'] = (boolean) Whether to ignore unavailable snapshots, defaults to false which means a SnapshotMissingException is thrown
     * $params['index_details']      = (boolean) Whether to include details of each index in the snapshot, if those details are available. Defaults to false.
     * $params['include_repository'] = (boolean) Whether to include the repository name in the snapshot info. Defaults to true.
     * $params['verbose']            = (boolean) Whether to show verbose snapshot info or only show the basic info found in the repository index blob
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function get(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $snapshot = $this->extractArgument($params, 'snapshot');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\Get $endpoint */
        $endpoint = $endpointBuilder('Snapshot\Get');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setSnapshot($snapshot);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about a repository.
     *
     * $params['repository']     = (list) A comma-separated list of repository names
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['local']          = (boolean) Return local information, do not retrieve the state from master node (default: false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function getRepository(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\GetRepository $endpoint */
        $endpoint = $endpointBuilder('Snapshot\GetRepository');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);

        return $this->performRequest($endpoint);
    }

    /**
     * Analyzes a repository for correctness and performance
     *
     * $params['repository']              = (string) A repository name
     * $params['blob_count']              = (number) Number of blobs to create during the test. Defaults to 100.
     * $params['concurrency']             = (number) Number of operations to run concurrently during the test. Defaults to 10.
     * $params['read_node_count']         = (number) Number of nodes on which to read a blob after writing. Defaults to 10.
     * $params['early_read_node_count']   = (number) Number of nodes on which to perform an early read on a blob, i.e. before writing has completed. Early reads are rare actions so the 'rare_action_probability' parameter is also relevant. Defaults to 2.
     * $params['seed']                    = (number) Seed for the random number generator used to create the test workload. Defaults to a random value.
     * $params['rare_action_probability'] = (number) Probability of taking a rare action such as an early read or an overwrite. Defaults to 0.02.
     * $params['max_blob_size']           = (string) Maximum size of a blob to create during the test, e.g '1gb' or '100mb'. Defaults to '10mb'.
     * $params['max_total_data_size']     = (string) Maximum total size of all blobs to create during the test, e.g '1tb' or '100gb'. Defaults to '1gb'.
     * $params['timeout']                 = (time) Explicit operation timeout. Defaults to '30s'.
     * $params['detailed']                = (boolean) Whether to return detailed results or a summary. Defaults to 'false' so that only the summary is returned.
     * $params['rarely_abort_writes']     = (boolean) Whether to rarely abort writes before they complete. Defaults to 'true'.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function repositoryAnalyze(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\RepositoryAnalyze $endpoint */
        $endpoint = $endpointBuilder('Snapshot\RepositoryAnalyze');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);

        return $this->performRequest($endpoint);
    }

    /**
     * Restores a snapshot.
     *
     * $params['repository']          = (string) A repository name
     * $params['snapshot']            = (string) A snapshot name
     * $params['master_timeout']      = (time) Explicit operation timeout for connection to master node
     * $params['wait_for_completion'] = (boolean) Should this request wait until the operation has completed before returning (Default = false)
     * $params['body']                = (array) Details of what to restore
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function restore(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $snapshot = $this->extractArgument($params, 'snapshot');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\Restore $endpoint */
        $endpoint = $endpointBuilder('Snapshot\Restore');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setSnapshot($snapshot);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns information about the status of a snapshot.
     *
     * $params['repository']         = (string) A repository name
     * $params['snapshot']           = (list) A comma-separated list of snapshot names
     * $params['master_timeout']     = (time) Explicit operation timeout for connection to master node
     * $params['ignore_unavailable'] = (boolean) Whether to ignore unavailable snapshots, defaults to false which means a SnapshotMissingException is thrown
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function status(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');
        $snapshot = $this->extractArgument($params, 'snapshot');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\Status $endpoint */
        $endpoint = $endpointBuilder('Snapshot\Status');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);
        $endpoint->setSnapshot($snapshot);

        return $this->performRequest($endpoint);
    }

    /**
     * Verifies a repository.
     *
     * $params['repository']     = (string) A repository name
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['timeout']        = (time) Explicit operation timeout
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     */
    public function verifyRepository(array $params = [])
    {
        $repository = $this->extractArgument($params, 'repository');

        $endpointBuilder = $this->endpoints;
        /** @var Snapshot\VerifyRepository $endpoint */
        $endpoint = $endpointBuilder('Snapshot\VerifyRepository');
        $endpoint->setParams($params);
        $endpoint->setRepository($repository);

        return $this->performRequest($endpoint);
    }
}