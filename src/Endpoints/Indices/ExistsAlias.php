<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:35:20
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ExistsAlias
 * Elasticsearch API name indices.exists_alias
 */
class ExistsAlias extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        if (isset($this->name) !== true) {
            throw new RuntimeException(
                'name is required for exists_alias'
            );
        }
        $name = $this->name;
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_alias/$name";
        }
        return "/_alias/$name";
    }

    public function getParamWhitelist(): array
    {
        return [
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'local'
        ];
    }

    public function getMethod(): string
    {
        return 'HEAD';
    }

    public function setName($name): ExistsAlias
    {
        if (isset($name) !== true) {
            return $this;
        }
        if (is_array($name) === true) {
            $name = implode(",", $name);
        }
        $this->name = $name;

        return $this;
    }
}
