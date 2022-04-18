<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:11:14
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Snapshot;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class RepositoryAnalyze
 * Elasticsearch API name snapshot.repository_analyze
 */
class RepositoryAnalyze extends AbstractEndpoint
{
    protected $repository;

    public function getURI(): string
    {
        $repository = $this->repository ?? null;

        if (isset($repository)) {
            return "/_snapshot/$repository/_analyze";
        }
        throw new RuntimeException('Missing parameter for the endpoint snapshot.repository_analyze');
    }

    public function getParamWhitelist(): array
    {
        return [
            'blob_count',
            'concurrency',
            'read_node_count',
            'early_read_node_count',
            'seed',
            'rare_action_probability',
            'max_blob_size',
            'max_total_data_size',
            'timeout',
            'detailed',
            'rarely_abort_writes'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setRepository($repository): RepositoryAnalyze
    {
        if (isset($repository) !== true) {
            return $this;
        }
        $this->repository = $repository;

        return $this;
    }
}