<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:55:02
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class UpdateAliases
 * Elasticsearch API name indices.update_aliases
 */
class UpdateAliases extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_aliases";
    }

    public function getParamWhitelist(): array
    {
        return [
            'timeout',
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): UpdateAliases
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}