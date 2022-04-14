<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:03:51
 */

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class Info
 * Elasticsearch API name info
 */
class Info extends AbstractEndpoint
{
    public function getURI(): string
    {

        return "/";
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