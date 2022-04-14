<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:49:11
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ccr;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteAutoFollowPattern
 * Elasticsearch API name ccr.delete_auto_follow_pattern
 */
class DeleteAutoFollowPattern extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_ccr/auto_follow/$name";
        }
        throw new RuntimeException('Missing parameter for the endpoint ccr.delete_auto_follow_pattern');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setName($name): DeleteAutoFollowPattern
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}