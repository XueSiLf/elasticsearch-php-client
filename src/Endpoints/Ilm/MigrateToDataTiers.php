<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:15:47
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ilm;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class MigrateToDataTiers
 * Elasticsearch API name ilm.migrate_to_data_tiers
 */
class MigrateToDataTiers extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ilm/migrate_to_data_tiers";
    }

    public function getParamWhitelist(): array
    {
        return [
            'dry_run'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): MigrateToDataTiers
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}