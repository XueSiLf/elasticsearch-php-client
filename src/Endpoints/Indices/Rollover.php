<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:48:50
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Indices;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Rollover
 * Elasticsearch API name indices.rollover
 */
class Rollover extends AbstractEndpoint
{
    protected $alias;
    protected $new_index;

    public function getURI(): string
    {
        if (isset($this->alias) !== true) {
            throw new RuntimeException(
                'alias is required for rollover'
            );
        }
        $alias = $this->alias;
        $new_index = $this->new_index ?? null;

        if (isset($new_index)) {
            return "/$alias/_rollover/$new_index";
        }
        return "/$alias/_rollover";
    }

    public function getParamWhitelist(): array
    {
        return [
            'include_type_name',
            'timeout',
            'dry_run',
            'master_timeout',
            'wait_for_active_shards'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Rollover
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setAlias($alias): Rollover
    {
        if (isset($alias) !== true) {
            return $this;
        }
        $this->alias = $alias;

        return $this;
    }

    public function setNewIndex($new_index): Rollover
    {
        if (isset($new_index) !== true) {
            return $this;
        }
        $this->new_index = $new_index;

        return $this;
    }
}