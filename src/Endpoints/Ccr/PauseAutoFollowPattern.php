<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:53:28
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ccr;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PauseAutoFollowPattern
 * Elasticsearch API name ccr.pause_auto_follow_pattern
 */
class PauseAutoFollowPattern extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_ccr/auto_follow/$name/pause";
        }
        throw new RuntimeException('Missing parameter for the endpoint ccr.pause_auto_follow_pattern');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setName($name): PauseAutoFollowPattern
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}