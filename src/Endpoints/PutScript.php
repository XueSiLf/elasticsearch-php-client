<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:05:34
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class PutScript
 * Elasticsearch API name put_script
 */
class PutScript extends AbstractEndpoint
{
    protected $context;

    public function getURI(): string
    {
        if (isset($this->id) !== true) {
            throw new RuntimeException(
                'id is required for put_script'
            );
        }
        $id = $this->id;
        $context = $this->context ?? null;

        if (isset($context)) {
            return "/_scripts/$id/$context";
        }
        return "/_scripts/$id";
    }

    public function getParamWhitelist(): array
    {
        return [
            'timeout',
            'master_timeout',
            'context'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): PutScript
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setContext($context): PutScript
    {
        if (isset($context) !== true) {
            return $this;
        }
        $this->context = $context;

        return $this;
    }
}