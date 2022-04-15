<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:44:12
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Rollup;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Rollup
 * Elasticsearch API name rollup.rollup
 */
class Rollup extends AbstractEndpoint
{
    protected $rollup_index;

    public function getURI(): string
    {
        $index = $this->index ?? null;
        $rollup_index = $this->rollup_index ?? null;

        if (isset($index) && isset($rollup_index)) {
            return "/$index/_rollup/$rollup_index";
        }
        throw new RuntimeException('Missing parameter for the endpoint rollup.rollup');
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Rollup
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setRollupIndex($rollup_index): Rollup
    {
        if (isset($rollup_index) !== true) {
            return $this;
        }
        $this->rollup_index = $rollup_index;

        return $this;
    }
}