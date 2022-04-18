<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:15:50
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetApiKey
 * Elasticsearch API name security.get_api_key
 */
class GetApiKey extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_security/api_key";
    }

    public function getParamWhitelist(): array
    {
        return [
            'id',
            'name',
            'username',
            'realm_name',
            'owner'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}