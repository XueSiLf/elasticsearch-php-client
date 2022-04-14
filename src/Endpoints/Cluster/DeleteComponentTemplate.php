<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:02:51
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteComponentTemplate
 * Elasticsearch API name cluster.delete_component_template
 */
class DeleteComponentTemplate extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_component_template/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint cluster.delete_component_template');
    }

    public function getParamWhitelist(): array
    {
        return [
            'timeout',
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setName($name): DeleteComponentTemplate
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}