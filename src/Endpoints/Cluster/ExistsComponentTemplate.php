<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:04:04
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Cluster;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ExistsComponentTemplate
 * Elasticsearch API name cluster.exists_component_template
 */
class ExistsComponentTemplate extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_component_template/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint cluster.exists_component_template');
    }

    public function getParamWhitelist(): array
    {
        return [
            'master_timeout',
            'local'
        ];
    }

    public function getMethod(): string
    {
        return 'HEAD';
    }

    public function setName($name): ExistsComponentTemplate
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}