<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:31:17
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class SamlServiceProviderMetadata
 * Elasticsearch API name security.saml_service_provider_metadata
 */
class SamlServiceProviderMetadata extends AbstractEndpoint
{
    protected $realm_name;

    public function getURI(): string
    {
        $realm_name = $this->realm_name ?? null;

        if (isset($realm_name)) {
            return "/_security/saml/metadata/$realm_name";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.saml_service_provider_metadata');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setRealmName($realm_name): SamlServiceProviderMetadata
    {
        if (isset($realm_name) !== true) {
            return $this;
        }
        $this->realm_name = $realm_name;

        return $this;
    }
}