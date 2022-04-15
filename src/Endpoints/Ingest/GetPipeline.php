<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:38:05
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ingest;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetPipeline
 * Elasticsearch API name ingest.get_pipeline
 */
class GetPipeline extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_ingest/pipeline/$id";
        }
        return "/_ingest/pipeline";
    }

    public function getParamWhitelist(): array
    {
        return [
            'summary',
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
