<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:53:11
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class DeleteByQuery
 * Elasticsearch API name delete_by_query
 */
class DeleteByQuery extends AbstractEndpoint
{
    public function getURI(): string
    {
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for delete_by_query'
            );
        }
        $index = $this->index;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($type)) {
            return "/$index/$type/_delete_by_query";
        }
        return "/$index/_delete_by_query";
    }

    public function getParamWhitelist(): array
    {
        return [
            'analyzer',
            'analyze_wildcard',
            'default_operator',
            'df',
            'from',
            'ignore_unavailable',
            'allow_no_indices',
            'conflicts',
            'expand_wildcards',
            'lenient',
            'preference',
            'q',
            'routing',
            'scroll',
            'search_type',
            'search_timeout',
            'size',
            'max_docs',
            'sort',
            'terminate_after',
            'stats',
            'version',
            'request_cache',
            'refresh',
            'timeout',
            'wait_for_active_shards',
            'scroll_size',
            'wait_for_completion',
            'requests_per_second',
            'slices'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): DeleteByQuery
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}