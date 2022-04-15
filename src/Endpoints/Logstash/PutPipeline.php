<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:52:39
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Logstash;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PutPipeline
 * Elasticsearch API name logstash.put_pipeline
 */
class PutPipeline extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_logstash/pipeline/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint logstash.put_pipeline');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): PutPipeline
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}