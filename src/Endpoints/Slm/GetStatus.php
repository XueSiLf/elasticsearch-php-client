<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:03:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Slm;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetStatus
 * Elasticsearch API name slm.get_status
 */
class GetStatus extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_slm/status";
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
