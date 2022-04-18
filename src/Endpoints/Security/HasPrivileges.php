<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:25:40
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class HasPrivileges
 * Elasticsearch API name security.has_privileges
 */
class HasPrivileges extends AbstractEndpoint
{
    protected $user;

    public function getURI(): string
    {
        $user = $this->user ?? null;

        if (isset($user)) {
            return "/_security/user/$user/_has_privileges";
        }
        return "/_security/user/_has_privileges";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): HasPrivileges
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setUser($user): HasPrivileges
    {
        if (isset($user) !== true) {
            return $this;
        }
        $this->user = $user;

        return $this;
    }
}
