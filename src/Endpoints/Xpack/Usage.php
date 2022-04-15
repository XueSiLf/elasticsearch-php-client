<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:32:52
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Xpack;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Usage
 * Elasticsearch API name xpack.usage
 */
class Usage extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_xpack/usage";
    }

    public function getParamWhitelist(): array
    {
        return [
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
