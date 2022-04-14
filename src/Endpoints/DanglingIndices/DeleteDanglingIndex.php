<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:17:50
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\DanglingIndices;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteDanglingIndex
 * Elasticsearch API name dangling_indices.delete_dangling_index
 */
class DeleteDanglingIndex extends AbstractEndpoint
{
    protected $index_uuid;

    public function getURI(): string
    {
        $index_uuid = $this->index_uuid ?? null;

        if (isset($index_uuid)) {
            return "/_dangling/$index_uuid";
        }
        throw new RuntimeException('Missing parameter for the endpoint dangling_indices.delete_dangling_index');
    }

    public function getParamWhitelist(): array
    {
        return [
            'accept_data_loss',
            'timeout',
            'master_timeout'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setIndexUuid($index_uuid): DeleteDanglingIndex
    {
        if (isset($index_uuid) !== true) {
            return $this;
        }
        $this->index_uuid = $index_uuid;

        return $this;
    }
}