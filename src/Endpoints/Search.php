<?php
/**
 * Created by PhpStorm.
 * Author: 黄龙辉 XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 10:58:55
 */

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class Search
 * Elasticsearch API name search
 */
class Search extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($index) && isset($type)) {
            return "/$index/$type/_search";
        }
        if (isset($index)) {
            return "/$index/_search";
        }
        return "/_search";
    }

    public function getParamWhitelist(): array
    {
        return [
            'analyzer',
            'analyze_wildcard',
            'ccs_minimize_roundtrips',
            'default_operator',
            'df',
            'explain',
            'stored_fields',
            'docvalue_fields',
            'from',
            'ignore_unavailable',
            'ignore_throttled',
            'allow_no_indices',
            'expand_wildcards',
            'lenient',
            'preference',
            'q',
            'routing',
            'scroll',
            'search_type',
            'size',
            'sort',
            '_source',
            '_source_excludes',
            '_source_includes',
            'terminate_after',
            'stats',
            'suggest_field',
            'suggest_mode',
            'suggest_size',
            'suggest_text',
            'timeout',
            'track_scores',
            'track_total_hits',
            'allow_partial_search_results',
            'typed_keys',
            'version',
            'seq_no_primary_term',
            'request_cache',
            'batched_reduce_size',
            'max_concurrent_shard_requests',
            'pre_filter_shard_size',
            'rest_total_hits_as_int',
            'min_compatible_shard_node'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): Search
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}