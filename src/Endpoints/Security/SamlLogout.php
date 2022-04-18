<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:30:32
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class SamlLogout
 * Elasticsearch API name security.saml_logout
 */
class SamlLogout extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_security/saml/logout";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): SamlLogout
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}