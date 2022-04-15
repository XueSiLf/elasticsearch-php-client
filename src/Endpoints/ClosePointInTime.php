<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:51:14
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

/**
 * Class ClosePointInTime
 * Elasticsearch API name close_point_in_time
 */
class ClosePointInTime extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_pit";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setBody($body): ClosePointInTime
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}