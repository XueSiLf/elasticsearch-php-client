<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 9:48:23
 */

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class Index
 * Elasticsearch API name index
 */
class Index extends AbstractEndpoint
{
    public function getURI(): string
    {
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for index'
            );
        }
        $index = $this->index;
        $id = $this->id ?? null;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($type) && isset($id)) {
            return "/$index/$type/$id";
        }
        if (isset($id)) {
            return "/$index/_doc/$id";
        }
        if (isset($type)) {
            return "/$index/$type";
        }
        return "/$index/_doc";
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_active_shards',
            'op_type',
            'refresh',
            'routing',
            'timeout',
            'version',
            'version_type',
            'if_seq_no',
            'if_primary_term',
            'pipeline',
            'require_alias'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Index
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}