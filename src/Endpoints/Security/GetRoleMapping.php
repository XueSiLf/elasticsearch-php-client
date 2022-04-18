<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:17:31
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetRoleMapping
 * Elasticsearch API name security.get_role_mapping
 */
class GetRoleMapping extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_security/role_mapping/$name";
        }
        return "/_security/role_mapping";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setName($name): GetRoleMapping
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