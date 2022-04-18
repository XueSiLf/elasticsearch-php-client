<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:18:47
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetServiceAccounts
 * Elasticsearch API name security.get_service_accounts
 */
class GetServiceAccounts extends AbstractEndpoint
{
    protected $namespace;
    protected $service;

    public function getURI(): string
    {
        $namespace = $this->namespace ?? null;
        $service = $this->service ?? null;

        if (isset($namespace) && isset($service)) {
            return "/_security/service/$namespace/$service";
        }
        if (isset($namespace)) {
            return "/_security/service/$namespace";
        }
        return "/_security/service";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setNamespace($namespace): GetServiceAccounts
    {
        if (isset($namespace) !== true) {
            return $this;
        }
        $this->namespace = $namespace;

        return $this;
    }

    public function setService($service): GetServiceAccounts
    {
        if (isset($service) !== true) {
            return $this;
        }
        $this->service = $service;

        return $this;
    }
}