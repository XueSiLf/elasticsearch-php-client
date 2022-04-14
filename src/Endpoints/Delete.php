<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 10:12:58
 */

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class Delete
 * Elasticsearch API name delete
 */
class Delete extends AbstractEndpoint
{
    public function getURI(): string
    {
        if (isset($this->id) !== true) {
            throw new RuntimeException(
                'id is required for delete'
            );
        }
        $id = $this->id;
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for delete'
            );
        }
        $index = $this->index;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($type)) {
            return "/$index/$type/$id";
        }
        return "/$index/_doc/$id";
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_active_shards',
            'refresh',
            'routing',
            'timeout',
            'if_seq_no',
            'if_primary_term',
            'version',
            'version_type'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }
}