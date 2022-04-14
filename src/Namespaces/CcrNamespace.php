<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:58:56
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\Elasticsearch\Endpoints\Ccr;

/**
 * Class CcrNamespace
 */
class CcrNamespace extends AbstractNamespace
{
    /**
     * Deletes auto-follow patterns.
     *
     * $params['name'] = (string) The name of the auto follow pattern.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-delete-auto-follow-pattern.html
     */
    public function deleteAutoFollowPattern(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\DeleteAutoFollowPattern $endpoint */
        $endpoint = $endpointBuilder('Ccr\DeleteAutoFollowPattern');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a new follower index configured to follow the referenced leader index.
     *
     * $params['index']                  = (string) The name of the follower index
     * $params['wait_for_active_shards'] = (string) Sets the number of shard copies that must be active before returning. Defaults to 0. Set to `all` for all shard copies, otherwise set to any non-negative value less than or equal to the total number of copies for the shard (number of replicas + 1) (Default = 0)
     * $params['body']                   = (array) The name of the leader index and other optional ccr related parameters (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-put-follow.html
     */
    public function follow(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\Follow $endpoint */
        $endpoint = $endpointBuilder('Ccr\Follow');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information about all follower indices, including parameters and status for each follower index
     *
     * $params['index'] = (list) A comma-separated list of index patterns; use `_all` to perform the operation on all indices
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-get-follow-info.html
     */
    public function followInfo(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\FollowInfo $endpoint */
        $endpoint = $endpointBuilder('Ccr\FollowInfo');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves follower stats. return shard-level stats about the following tasks associated with each shard for the specified indices.
     *
     * $params['index'] = (list) A comma-separated list of index patterns; use `_all` to perform the operation on all indices
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-get-follow-stats.html
     */
    public function followStats(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\FollowStats $endpoint */
        $endpoint = $endpointBuilder('Ccr\FollowStats');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Removes the follower retention leases from the leader.
     *
     * $params['index'] = (string) the name of the leader index for which specified follower retention leases should be removed
     * $params['body']  = (array) the name and UUID of the follower index, the name of the cluster containing the follower index, and the alias from the perspective of that cluster for the remote cluster containing the leader index (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-post-forget-follower.html
     */
    public function forgetFollower(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\ForgetFollower $endpoint */
        $endpoint = $endpointBuilder('Ccr\ForgetFollower');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets configured auto-follow patterns. Returns the specified auto-follow pattern collection.
     *
     * $params['name'] = (string) The name of the auto follow pattern.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-get-auto-follow-pattern.html
     */
    public function getAutoFollowPattern(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\GetAutoFollowPattern $endpoint */
        $endpoint = $endpointBuilder('Ccr\GetAutoFollowPattern');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Pauses an auto-follow pattern
     *
     * $params['name'] = (string) The name of the auto follow pattern that should pause discovering new indices to follow.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-pause-auto-follow-pattern.html
     */
    public function pauseAutoFollowPattern(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\PauseAutoFollowPattern $endpoint */
        $endpoint = $endpointBuilder('Ccr\PauseAutoFollowPattern');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Pauses a follower index. The follower index will not fetch any additional operations from the leader index.
     *
     * $params['index'] = (string) The name of the follower index that should pause following its leader index.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-post-pause-follow.html
     */
    public function pauseFollow(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\PauseFollow $endpoint */
        $endpoint = $endpointBuilder('Ccr\PauseFollow');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a new named collection of auto-follow patterns against a specified remote cluster. Newly created indices on the remote cluster matching any of the specified patterns will be automatically configured as follower indices.
     *
     * $params['name'] = (string) The name of the auto follow pattern.
     * $params['body'] = (array) The specification of the auto follow pattern (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-put-auto-follow-pattern.html
     */
    public function putAutoFollowPattern(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\PutAutoFollowPattern $endpoint */
        $endpoint = $endpointBuilder('Ccr\PutAutoFollowPattern');
        $endpoint->setParams($params);
        $endpoint->setName($name);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Resumes an auto-follow pattern that has been paused
     *
     * $params['name'] = (string) The name of the auto follow pattern to resume discovering new indices to follow.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-resume-auto-follow-pattern.html
     */
    public function resumeAutoFollowPattern(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\ResumeAutoFollowPattern $endpoint */
        $endpoint = $endpointBuilder('Ccr\ResumeAutoFollowPattern');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Resumes a follower index that has been paused
     *
     * $params['index'] = (string) The name of the follow index to resume following.
     * $params['body']  = (array) The name of the leader index and other optional ccr related parameters
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-post-resume-follow.html
     */
    public function resumeFollow(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\ResumeFollow $endpoint */
        $endpoint = $endpointBuilder('Ccr\ResumeFollow');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets all stats related to cross-cluster replication.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-get-stats.html
     */
    public function stats(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ccr\Stats $endpoint */
        $endpoint = $endpointBuilder('Ccr\Stats');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Stops the following task associated with a follower index and removes index metadata and settings associated with cross-cluster replication.
     *
     * $params['index'] = (string) The name of the follower index that should be turned into a regular index.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ccr-post-unfollow.html
     */
    public function unfollow(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Ccr\Unfollow $endpoint */
        $endpoint = $endpointBuilder('Ccr\Unfollow');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }
}