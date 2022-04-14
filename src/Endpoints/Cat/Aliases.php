<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:04:03
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Aliases
 * Elasticsearch API name cat.aliases
 */
class Aliases extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_cat/aliases/$name";
        }
        return "/_cat/aliases";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'local',
            'h',
            'help',
            's',
            'v',
            'expand_wildcards'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setName($name): Aliases
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