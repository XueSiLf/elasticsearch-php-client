<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:09:59
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearCachedRealms
 * Elasticsearch API name security.clear_cached_realms
 */
class ClearCachedRealms extends AbstractEndpoint
{
    protected $realms;

    public function getURI(): string
    {
        $realms = $this->realms ?? null;

        if (isset($realms)) {
            return "/_security/realm/$realms/_clear_cache";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.clear_cached_realms');
    }

    public function getParamWhitelist(): array
    {
        return [
            'usernames'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setRealms($realms): ClearCachedRealms
    {
        if (isset($realms) !== true) {
            return $this;
        }
        if (is_array($realms) === true) {
            $realms = implode(",", $realms);
        }
        $this->realms = $realms;

        return $this;
    }
}
