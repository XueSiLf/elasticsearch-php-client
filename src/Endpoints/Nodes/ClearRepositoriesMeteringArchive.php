<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:12:29
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Nodes;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ClearRepositoriesMeteringArchive
 * Elasticsearch API name nodes.clear_repositories_metering_archive
 */
class ClearRepositoriesMeteringArchive extends AbstractEndpoint
{
    protected $node_id;
    protected $max_archive_version;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;
        $max_archive_version = $this->max_archive_version ?? null;

        if (isset($node_id) && isset($max_archive_version)) {
            return "/_nodes/$node_id/_repositories_metering/$max_archive_version";
        }
        throw new RuntimeException('Missing parameter for the endpoint nodes.clear_repositories_metering_archive');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setNodeId($node_id): ClearRepositoriesMeteringArchive
    {
        if (isset($node_id) !== true) {
            return $this;
        }
        if (is_array($node_id) === true) {
            $node_id = implode(",", $node_id);
        }
        $this->node_id = $node_id;

        return $this;
    }

    public function setMaxArchiveVersion($max_archive_version): ClearRepositoriesMeteringArchive
    {
        if (isset($max_archive_version) !== true) {
            return $this;
        }
        $this->max_archive_version = $max_archive_version;

        return $this;
    }
}