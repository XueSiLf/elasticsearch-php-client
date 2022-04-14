<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:03:37
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteVotingConfigExclusions
 * Elasticsearch API name cluster.delete_voting_config_exclusions
 */
class DeleteVotingConfigExclusions extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_cluster/voting_config_exclusions";
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_removal'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }
}