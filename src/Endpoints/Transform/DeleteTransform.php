<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:15:02
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Transform;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteTransform
 * Elasticsearch API name transform.delete_transform
 */
class DeleteTransform extends AbstractEndpoint
{
    protected $transform_id;

    public function getURI(): string
    {
        $transform_id = $this->transform_id ?? null;

        if (isset($transform_id)) {
            return "/_transform/$transform_id";
        }
        throw new RuntimeException('Missing parameter for the endpoint transform.delete_transform');
    }

    public function getParamWhitelist(): array
    {
        return [
            'force',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setTransformId($transform_id): DeleteTransform
    {
        if (isset($transform_id) !== true) {
            return $this;
        }
        $this->transform_id = $transform_id;

        return $this;
    }
}