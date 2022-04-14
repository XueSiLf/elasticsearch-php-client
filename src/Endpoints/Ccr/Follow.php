<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:50:07
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ccr;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Follow
 * Elasticsearch API name ccr.follow
 */
class Follow extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_ccr/follow";
        }
        throw new RuntimeException('Missing parameter for the endpoint ccr.follow');
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_active_shards'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): Follow
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
