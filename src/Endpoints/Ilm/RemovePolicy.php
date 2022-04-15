<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:17:21
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ilm;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class RemovePolicy
 * Elasticsearch API name ilm.remove_policy
 */
class RemovePolicy extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_ilm/remove";
        }
        throw new RuntimeException('Missing parameter for the endpoint ilm.remove_policy');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}