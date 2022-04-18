<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 14:49:57
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\SearchableSnapshots;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Mount
 * Elasticsearch API name searchable_snapshots.mount
 */
class Mount extends AbstractEndpoint
{
    protected $repository;
    protected $snapshot;

    public function getURI(): string
    {
        $repository = $this->repository ?? null;
        $snapshot = $this->snapshot ?? null;

        if (isset($repository) && isset($snapshot)) {
            return "/_snapshot/$repository/$snapshot/_mount";
        }
        throw new RuntimeException('Missing parameter for the endpoint searchable_snapshots.mount');
    }

    public function getParamWhitelist(): array
    {
        return [
            'master_timeout',
            'wait_for_completion',
            'storage'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): Mount
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setRepository($repository): Mount
    {
        if (isset($repository) !== true) {
            return $this;
        }
        $this->repository = $repository;

        return $this;
    }

    public function setSnapshot($snapshot): Mount
    {
        if (isset($snapshot) !== true) {
            return $this;
        }
        $this->snapshot = $snapshot;

        return $this;
    }
}
