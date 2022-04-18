<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:12:16
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeletePrivileges
 * Elasticsearch API name security.delete_privileges
 */
class DeletePrivileges extends AbstractEndpoint
{
    protected $application;
    protected $name;

    public function getURI(): string
    {
        $application = $this->application ?? null;
        $name = $this->name ?? null;

        if (isset($application) && isset($name)) {
            return "/_security/privilege/$application/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.delete_privileges');
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

    public function setApplication($application): DeletePrivileges
    {
        if (isset($application) !== true) {
            return $this;
        }
        $this->application = $application;

        return $this;
    }

    public function setName($name): DeletePrivileges
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}
