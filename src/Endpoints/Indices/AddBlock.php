<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:27:09
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class AddBlock
 * Elasticsearch API name indices.add_block
 */
class AddBlock extends AbstractEndpoint
{
    protected $block;

    public function getURI(): string
    {
        $index = $this->index ?? null;
        $block = $this->block ?? null;

        if (isset($index) && isset($block)) {
            return "/$index/_block/$block";
        }
        throw new RuntimeException('Missing parameter for the endpoint indices.add_block');
    }

    public function getParamWhitelist(): array
    {
        return [
            'timeout',
            'master_timeout',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBlock($block): AddBlock
    {
        if (isset($block) !== true) {
            return $this;
        }
        $this->block = $block;

        return $this;
    }
}