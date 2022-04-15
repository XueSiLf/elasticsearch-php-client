<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 10:37:03
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetSettings
 * Elasticsearch API name indices.get_settings
 */
class GetSettings extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $index = $this->index ?? null;
        $name = $this->name ?? null;

        if (isset($index) && isset($name)) {
            return "/$index/_settings/$name";
        }
        if (isset($index)) {
            return "/$index/_settings";
        }
        if (isset($name)) {
            return "/_settings/$name";
        }
        return "/_settings";
    }

    public function getParamWhitelist(): array
    {
        return [
            'master_timeout',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'flat_settings',
            'local',
            'include_defaults'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setName($name): GetSettings
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