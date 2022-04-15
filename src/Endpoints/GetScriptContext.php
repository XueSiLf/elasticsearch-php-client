<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:58:34
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class GetScriptContext
 * Elasticsearch API name get_script_context
 */
class GetScriptContext extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_script_context";
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