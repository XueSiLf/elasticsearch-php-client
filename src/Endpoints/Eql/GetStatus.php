<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:35:02
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Eql;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetStatus
 * Elasticsearch API name eql.get_status
 */
class GetStatus extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_eql/search/status/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint eql.get_status');
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
