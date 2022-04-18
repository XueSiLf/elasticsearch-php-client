<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:14:11
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteServiceToken
 * Elasticsearch API name security.delete_service_token
 */
class DeleteServiceToken extends AbstractEndpoint
{
    protected $namespace;
    protected $service;
    protected $name;

    public function getURI(): string
    {
        $namespace = $this->namespace ?? null;
        $service = $this->service ?? null;
        $name = $this->name ?? null;

        if (isset($namespace) && isset($service) && isset($name)) {
            return "/_security/service/$namespace/$service/credential/token/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.delete_service_token');
    }

    public function getParamWhitelist(): array
    {
        return [
            'refresh'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setNamespace($namespace): DeleteServiceToken
    {
        if (isset($namespace) !== true) {
            return $this;
        }
        $this->namespace = $namespace;

        return $this;
    }

    public function setService($service): DeleteServiceToken
    {
        if (isset($service) !== true) {
            return $this;
        }
        $this->service = $service;

        return $this;
    }

    public function setName($name): DeleteServiceToken
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}