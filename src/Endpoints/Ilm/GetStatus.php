<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:15:14
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ilm;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetStatus
 * Elasticsearch API name ilm.get_status
 */
class GetStatus extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ilm/status";
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
