<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:06:28
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Migration;

/**
 * Class MigrationNamespace
 */
class MigrationNamespace extends AbstractNamespace
{
    /**
     * Retrieves information about different cluster, node, and index level settings that use deprecated features that will be removed or changed in the next major version.
     *
     * $params['index'] = (string) Index pattern
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/migration-api-deprecation.html
     */
    public function deprecations(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');

        $endpointBuilder = $this->endpoints;
        /** @var Migration\Deprecations $endpoint */
        $endpoint = $endpointBuilder('Migration\Deprecations');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);

        return $this->performRequest($endpoint);
    }

    /**
     * Find out whether system features need to be upgraded or not
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/migration-api-feature-upgrade.html
     */
    public function getFeatureUpgradeStatus(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Migration\GetFeatureUpgradeStatus $endpoint */
        $endpoint = $endpointBuilder('Migration\GetFeatureUpgradeStatus');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Begin upgrades for system features
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/migration-api-feature-upgrade.html
     */
    public function postFeatureUpgrade(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Migration\PostFeatureUpgrade $endpoint */
        $endpoint = $endpointBuilder('Migration\PostFeatureUpgrade');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}