<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:06:43
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PostVotingConfigExclusions
 * Elasticsearch API name cluster.post_voting_config_exclusions
 */
class PostVotingConfigExclusions extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cluster/voting_config_exclusions";
    }

    public function getParamWhitelist(): array
    {
        return [
            'node_ids',
            'node_names',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}
