<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:43:15
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\License;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetTrialStatus
 * Elasticsearch API name license.get_trial_status
 */
class GetTrialStatus extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_license/trial_status";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
