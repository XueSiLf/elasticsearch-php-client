<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:25:21
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GrantApiKey
 * Elasticsearch API name security.grant_api_key
 */
class GrantApiKey extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_security/api_key/grant";
    }

    public function getParamWhitelist(): array
    {
        return [
            'refresh'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): GrantApiKey
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}