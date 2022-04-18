<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:10:56
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearCachedServiceTokens
 * Elasticsearch API name security.clear_cached_service_tokens
 */
class ClearCachedServiceTokens extends AbstractEndpoint
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
            return "/_security/service/$namespace/$service/credential/token/$name/_clear_cache";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.clear_cached_service_tokens');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setNamespace($namespace): ClearCachedServiceTokens
    {
        if (isset($namespace) !== true) {
            return $this;
        }
        $this->namespace = $namespace;

        return $this;
    }

    public function setService($service): ClearCachedServiceTokens
    {
        if (isset($service) !== true) {
            return $this;
        }
        $this->service = $service;

        return $this;
    }

    public function setName($name): ClearCachedServiceTokens
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
