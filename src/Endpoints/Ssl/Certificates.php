<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:18:57
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ssl;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Certificates
 * Elasticsearch API name ssl.certificates
 */
class Certificates extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ssl/certificates";
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