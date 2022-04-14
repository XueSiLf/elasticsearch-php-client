<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:28:45
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Enrich;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ExecutePolicy
 * Elasticsearch API name enrich.execute_policy
 */
class ExecutePolicy extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_enrich/policy/$name/_execute";
        }
        throw new RuntimeException('Missing parameter for the endpoint enrich.execute_policy');
    }

    public function getParamWhitelist(): array
    {
        return [
            'wait_for_completion'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setName($name): ExecutePolicy
    {
        if (isset($name) !== true) {
            return $this;
        }
        $this->name = $name;

        return $this;
    }
}
