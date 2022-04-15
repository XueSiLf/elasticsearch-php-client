<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:40:54
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetDataStream
 * Elasticsearch API name indices.get_data_stream
 */
class GetDataStream extends AbstractEndpoint
{
    protected $name;

    public function getURI(): string
    {
        $name = $this->name ?? null;

        if (isset($name)) {
            return "/_data_stream/$name";
        }
        return "/_data_stream";
    }

    public function getParamWhitelist(): array
    {
        return [
            'expand_wildcards'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setName($name): GetDataStream
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