<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:41:27
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Transforms
 * Elasticsearch API name cat.transforms
 */
class Transforms extends AbstractEndpoint
{
    protected $transform_id;

    public function getURI(): string
    {
        $transform_id = $this->transform_id ?? null;

        if (isset($transform_id)) {
            return "/_cat/transforms/$transform_id";
        }
        return "/_cat/transforms";
    }

    public function getParamWhitelist(): array
    {
        return [
            'from',
            'size',
            'allow_no_match',
            'format',
            'h',
            'help',
            's',
            'time',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setTransformId($transform_id): Transforms
    {
        if (isset($transform_id) !== true) {
            return $this;
        }
        $this->transform_id = $transform_id;

        return $this;
    }
}
