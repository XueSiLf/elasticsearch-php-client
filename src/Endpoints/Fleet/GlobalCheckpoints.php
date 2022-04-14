<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:40:42
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Fleet;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GlobalCheckpoints
 * Elasticsearch API name fleet.global_checkpoints
 */
class GlobalCheckpoints extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_fleet/global_checkpoints";
        }
        throw new RuntimeException('Missing parameter for the endpoint fleet.global_checkpoints');
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_advance',
            'wait_for_index',
            'checkpoints',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}