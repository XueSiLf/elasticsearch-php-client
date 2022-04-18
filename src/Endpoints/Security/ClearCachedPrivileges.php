<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:09:29
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearCachedPrivileges
 * Elasticsearch API name security.clear_cached_privileges
 */
class ClearCachedPrivileges extends AbstractEndpoint
{
    protected $application;

    public function getURI(): string
    {
        $application = $this->application ?? null;

        if (isset($application)) {
            return "/_security/privilege/$application/_clear_cache";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.clear_cached_privileges');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setApplication($application): ClearCachedPrivileges
    {
        if (isset($application) !== true) {
            return $this;
        }
        if (is_array($application) === true) {
            $application = implode(",", $application);
        }
        $this->application = $application;

        return $this;
    }
}