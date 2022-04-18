<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:08:05
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Snapshot;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class CloneSnapshot
 * Elasticsearch API name snapshot.clone
 */
class CloneSnapshot extends AbstractEndpoint
{
    protected $repository;
    protected $snapshot;
    protected $target_snapshot;

    public function getURI(): string
    {
        $repository = $this->repository ?? null;
        $snapshot = $this->snapshot ?? null;
        $target_snapshot = $this->target_snapshot ?? null;

        if (isset($repository) && isset($snapshot) && isset($target_snapshot)) {
            return "/_snapshot/$repository/$snapshot/_clone/$target_snapshot";
        }
        throw new RuntimeException('Missing parameter for the endpoint snapshot.clone');
    }

    public function getParamWhitelist(): array
    {
        return [
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function setBody($body): CloneSnapshot
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setRepository($repository): CloneSnapshot
    {
        if (isset($repository) !== true) {
            return $this;
        }
        $this->repository = $repository;

        return $this;
    }

    public function setSnapshot($snapshot): CloneSnapshot
    {
        if (isset($snapshot) !== true) {
            return $this;
        }
        $this->snapshot = $snapshot;

        return $this;
    }

    public function setTargetSnapshot($target_snapshot): CloneSnapshot
    {
        if (isset($target_snapshot) !== true) {
            return $this;
        }
        $this->target_snapshot = $target_snapshot;

        return $this;
    }
}