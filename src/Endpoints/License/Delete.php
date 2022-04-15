<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:41:45
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\License;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Delete
 * Elasticsearch API name license.delete
 */
class Delete extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_license";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }
}