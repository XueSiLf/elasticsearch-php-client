<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:11:50
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class CreateServiceToken
 * Elasticsearch API name security.create_service_token
 */
class CreateServiceToken extends AbstractEndpoint
{
    protected $namespace;
    protected $service;
    protected $name;

    public function getURI(): string
    {
        if (isset($this->namespace) !== true) {
            throw new RuntimeException(
                'namespace is required for create_service_token'
            );
        }
        $namespace = $this->namespace;
        if (isset($this->service) !== true) {
            throw new RuntimeException(
                'service is required for create_service_token'
            );
        }
        $service = $this->service;
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_security/service/$namespace/$service/credential/token/$name";
        }
        return "/_security/service/$namespace/$service/credential/token";
    }

    public function getParamWhitelist(): array
    {
        return [
            'refresh'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setNamespace($namespace): CreateServiceToken
    {
        if (isset($namespace) !== true) {
            return $this;
        }
        $this->namespace = $namespace;

        return $this;
    }

    public function setService($service): CreateServiceToken
    {
        if (isset($service) !== true) {
            return $this;
        }
        $this->service = $service;

        return $this;
    }

    public function setName($name): CreateServiceToken
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}