<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:57:23
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class FieldCaps
 * Elasticsearch API name field_caps
 */
class FieldCaps extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_field_caps";
        }
        return "/_field_caps";
    }

    public function getParamWhitelist(): array
    {
        return [
            'fields',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'include_unmapped'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): FieldCaps
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}