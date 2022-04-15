<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:59:01
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class GetScriptLanguages
 * Elasticsearch API name get_script_languages
 */
class GetScriptLanguages extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_script_language";
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
