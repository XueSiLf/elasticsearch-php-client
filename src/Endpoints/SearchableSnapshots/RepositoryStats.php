<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 14:50:35
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\SearchableSnapshots;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class RepositoryStats
 * Elasticsearch API name searchable_snapshots.repository_stats
 */
class RepositoryStats extends AbstractEndpoint
{
    protected $repository;

    public function getURI(): string
    {
        $repository = $this->repository ?? null;

        if (isset($repository)) {
            return "/_snapshot/$repository/_stats";
        }
        throw new RuntimeException('Missing parameter for the endpoint searchable_snapshots.repository_stats');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setRepository($repository): RepositoryStats
    {
        if (isset($repository) !== true) {
            return $this;
        }
        $this->repository = $repository;

        return $this;
    }
}