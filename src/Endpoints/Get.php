<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 9:57:26
 */

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class Get
 * Elasticsearch API name get
 */
class Get extends AbstractEndpoint
{
    public function getURI(): string
    {
        if (isset($this->id) !== true) {
            throw new RuntimeException(
                'id is required for get'
            );
        }
        $id = $this->id;
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for get'
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
            'stored_fields',
            'preference',
            'realtime',
            'refresh',
            'routing',
            '_source',
            '_source_excludes',
            '_source_includes',
            'version',
            'version_type'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
