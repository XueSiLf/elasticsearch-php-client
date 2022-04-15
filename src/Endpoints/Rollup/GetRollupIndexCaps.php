<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:43:21
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Rollup;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetRollupIndexCaps
 * Elasticsearch API name rollup.get_rollup_index_caps
 */
class GetRollupIndexCaps extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_rollup/data";
        }
        throw new RuntimeException('Missing parameter for the endpoint rollup.get_rollup_index_caps');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}