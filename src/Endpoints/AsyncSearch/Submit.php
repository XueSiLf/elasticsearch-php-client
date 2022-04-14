<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:52:03
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\AsyncSearch;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Submit
 * Elasticsearch API name async_search.submit
 */
class Submit extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_async_search";
        }
        return "/_async_search";
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_completion_timeout',
            'keep_on_completion',
            'keep_alive',
            'batched_reduce_size',
            'request_cache',
            'analyzer',
            'analyze_wildcard',
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
            'max_concurrent_shard_requests'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Submit
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}