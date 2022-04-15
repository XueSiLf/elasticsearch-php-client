<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:10:42
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class SearchTemplate
 * Elasticsearch API name search_template
 */
class SearchTemplate extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($index) && isset($type)) {
            return "/$index/$type/_search/template";
        }
        if (isset($index)) {
            return "/$index/_search/template";
        }
        return "/_search/template";
    }

    public function getParamWhitelist(): array
    {
        return [
            'ignore_unavailable',
            'ignore_throttled',
            'allow_no_indices',
            'expand_wildcards',
            'preference',
            'routing',
            'scroll',
            'search_type',
            'explain',
            'profile',
            'typed_keys',
            'rest_total_hits_as_int',
            'ccs_minimize_roundtrips'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): SearchTemplate
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
