<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:12:10
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Snapshot;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Status
 * Elasticsearch API name snapshot.status
 */
class Status extends AbstractEndpoint
{
    protected $repository;
    protected $snapshot;

    public function getURI(): string
    {
        $repository = $this->repository ?? null;
        $snapshot = $this->snapshot ?? null;

        if (isset($repository) && isset($snapshot)) {
            return "/_snapshot/$repository/$snapshot/_status";
        }
        if (isset($repository)) {
            return "/_snapshot/$repository/_status";
        }
        return "/_snapshot/_status";
    }

    public function getParamWhitelist(): array
    {
        return [
            'master_timeout',
            'ignore_unavailable'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setRepository($repository): Status
    {
        if (isset($repository) !== true) {
            return $this;
        }
        $this->repository = $repository;

        return $this;
    }

    public function setSnapshot($snapshot): Status
    {
        if (isset($snapshot) !== true) {
            return $this;
        }
        if (is_array($snapshot) === true) {
            $snapshot = implode(",", $snapshot);
        }
        $this->snapshot = $snapshot;

        return $this;
    }
}
