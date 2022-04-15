<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:30:04
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetModelSnapshotUpgradeStats
 * Elasticsearch API name ml.get_model_snapshot_upgrade_stats
 */
class GetModelSnapshotUpgradeStats extends AbstractEndpoint
{
    protected $job_id;
    protected $snapshot_id;

    public function getURI(): string
    {
        $job_id = $this->job_id ?? null;
        $snapshot_id = $this->snapshot_id ?? null;

        if (isset($job_id) && isset($snapshot_id)) {
            return "/_ml/anomaly_detectors/$job_id/model_snapshots/$snapshot_id/_upgrade/_stats";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.get_model_snapshot_upgrade_stats');
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setJobId($job_id): GetModelSnapshotUpgradeStats
    {
        if (isset($job_id) !== true) {
            return $this;
        }
        $this->job_id = $job_id;

        return $this;
    }

    public function setSnapshotId($snapshot_id): GetModelSnapshotUpgradeStats
    {
        if (isset($snapshot_id) !== true) {
            return $this;
        }
        $this->snapshot_id = $snapshot_id;

        return $this;
    }
}