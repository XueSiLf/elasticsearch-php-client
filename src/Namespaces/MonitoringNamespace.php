<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:10:26
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Monitoring;

/**
 * Class MonitoringNamespace
 */
class MonitoringNamespace extends AbstractNamespace
{
    /**
     * Used by the monitoring features to send monitoring data.
     *
     * $params['type']               = DEPRECATED (string) Default document type for items which don't provide one
     * $params['system_id']          = (string) Identifier of the monitored system
     * $params['system_api_version'] = (string) API Version of the monitored system
     * $params['interval']           = (string) Collection interval (e.g., '10s' or '10000ms') of the payload
     * $params['body']               = (array) The operation definition and data (action-data pairs), separated by newlines (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/monitor-elasticsearch-cluster.html
     */
    public function bulk(array $params = [])
    {
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Monitoring\Bulk $endpoint */
        $endpoint = $endpointBuilder('Monitoring\Bulk');
        $endpoint->setParams($params);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}