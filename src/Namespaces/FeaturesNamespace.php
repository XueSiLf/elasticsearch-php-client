<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:38:57
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\Elasticsearch\Endpoints\Features;

/**
 * Class FeaturesNamespace
 */
class FeaturesNamespace extends AbstractNamespace
{
    /**
     * Gets a list of features which can be included in snapshots using the feature_states field when creating a snapshot
     *
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/get-features-api.html
     */
    public function getFeatures(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Features\GetFeatures $endpoint */
        $endpoint = $endpointBuilder('Features\GetFeatures');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Resets the internal state of features, usually by deleting system indices
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/modules-snapshots.html
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function resetFeatures(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Features\ResetFeatures $endpoint */
        $endpoint = $endpointBuilder('Features\ResetFeatures');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}