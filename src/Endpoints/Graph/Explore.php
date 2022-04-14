<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:44:27
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Graph;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Explore
 * Elasticsearch API name graph.explore
 */
class Explore extends AbstractEndpoint
{
    public function getURI(): string
    {
        if (isset($this->index) !== true) {
            throw new RuntimeException(
                'index is required for explore'
            );
        }
        $index = $this->index;
        $type = $this->type ?? null;
        if (isset($type)) {
            @trigger_error('Specifying types in urls has been deprecated', E_USER_DEPRECATED);
        }

        if (isset($type)) {
            return "/$index/$type/_graph/explore";
        }
        return "/$index/_graph/explore";
    }

    public function getParamWhitelist(): array
    {
        return [
            'routing',
            'timeout'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): Explore
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}