<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:30:23
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Enrich;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetPolicy
 * Elasticsearch API name enrich.get_policy
 */
class GetPolicy extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_enrich/policy/$name";
        }
        return "/_enrich/policy/";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setName($name): GetPolicy
    {
        if (isset($name) !== true) {
            return $this;
        }
        if (is_array($name) === true) {
            $name = implode(",", $name);
        }
        $this->name = $name;

        return $this;
    }
}