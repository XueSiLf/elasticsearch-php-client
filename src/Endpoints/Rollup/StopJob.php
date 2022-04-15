<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:45:58
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Rollup;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class StopJob
 * Elasticsearch API name rollup.stop_job
 */
class StopJob extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_rollup/job/$id/_stop";
        }
        throw new RuntimeException('Missing parameter for the endpoint rollup.stop_job');
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_completion',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}
