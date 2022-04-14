<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 10:10:24
 */

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class Update
 * Elasticsearch API name update
 */
class Update extends AbstractEndpoint
{
    public function getURI(): string
    {
        if (isset($this->id) !== true) {
            throw new RuntimeException(
                'id is required for update'
            );
        }
        $id = $this->id;
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for update'
            );
        }
        $index = $this->index;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($type)) {
            return "/$index/$type/$id/_update";
        }
        return "/$index/_update/$id";
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_active_shards',
            '_source',
            '_source_excludes',
            '_source_includes',
            'lang',
            'refresh',
            'retry_on_conflict',
            'routing',
            'timeout',
            'if_seq_no',
            'if_primary_term',
            'require_alias'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Update
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}