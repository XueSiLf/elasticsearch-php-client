<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:24:21
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetUser
 * Elasticsearch API name security.get_user
 */
class GetUser extends AbstractEndpoint
{
    protected $username;

    public function getURI(): string
    {
        $username = $this->username ?? null;

        if (isset($username)) {
            return "/_security/user/$username";
        }
        return "/_security/user";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setUsername($username): GetUser
    {
        if (isset($username) !== true) {
            return $this;
        }
        if (is_array($username) === true) {
            $username = implode(",", $username);
        }
        $this->username = $username;

        return $this;
    }
}