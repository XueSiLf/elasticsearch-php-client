<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:14:06
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ilm;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ExplainLifecycle
 * Elasticsearch API name ilm.explain_lifecycle
 */
class ExplainLifecycle extends AbstractEndpoint
{
    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_ilm/explain";
        }
        throw new RuntimeException('Missing parameter for the endpoint ilm.explain_lifecycle');
    }

    public function getParamWhitelist(): array
    {
        return [
            'only_managed',
            'only_errors'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
