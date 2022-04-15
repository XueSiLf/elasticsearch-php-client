<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:08:03
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class ScriptsPainlessExecute
 * Elasticsearch API name scripts_painless_execute
 */
class ScriptsPainlessExecute extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_scripts/painless/_execute";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): ScriptsPainlessExecute
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
