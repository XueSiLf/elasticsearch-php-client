<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:42:06
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Rollup;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteJob
 * Elasticsearch API name rollup.delete_job
 */
class DeleteJob extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_rollup/job/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint rollup.delete_job');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }
}