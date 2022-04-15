<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:38:30
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ingest;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ProcessorGrok
 * Elasticsearch API name ingest.processor_grok
 */
class ProcessorGrok extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ingest/processor/grok";
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
