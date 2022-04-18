<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 18:09:06
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Security;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearApiKeyCache
 * Elasticsearch API name security.clear_api_key_cache
 */
class ClearApiKeyCache extends AbstractEndpoint
{
    protected $ids;

    public function getURI(): string
    {
        $ids = $this->ids ?? null;

        if (isset($ids)) {
            return "/_security/api_key/$ids/_clear_cache";
        }
        throw new RuntimeException('Missing parameter for the endpoint security.clear_api_key_cache');
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setIds($ids): ClearApiKeyCache
    {
        if (isset($ids) !== true) {
            return $this;
        }
        if (is_array($ids) === true) {
            $ids = implode(",", $ids);
        }
        $this->ids = $ids;

        return $this;
    }
}