<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:19:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetServiceCredentials
 * Elasticsearch API name security.get_service_credentials
 */
class GetServiceCredentials extends AbstractEndpoint
{
    protected $namespace;
    protected $service;

    public function getURI(): string
    {
        $namespace = $this->namespace ?? null;
        $service = $this->service ?? null;

        if (isset($namespace) && isset($service)) {
            return "/_security/service/$namespace/$service/credential";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.get_service_credentials');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setNamespace($namespace): GetServiceCredentials
    {
        if (isset($namespace) !== true) {
            return $this;
        }
        $this->namespace = $namespace;

        return $this;
    }

    public function setService($service): GetServiceCredentials
    {
        if (isset($service) !== true) {
            return $this;
        }
        $this->service = $service;

        return $this;
    }
}