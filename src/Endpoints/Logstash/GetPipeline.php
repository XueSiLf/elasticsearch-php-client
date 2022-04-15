<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:52:11
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Logstash;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetPipeline
 * Elasticsearch API name logstash.get_pipeline
 */
class GetPipeline extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_logstash/pipeline/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint logstash.get_pipeline');
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}