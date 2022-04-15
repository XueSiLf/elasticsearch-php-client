<?php
/** * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:53:23
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Logstash;

/**
 * Class LogstashNamespace
 */
class LogstashNamespace extends AbstractNamespace
{
    /**
     * Deletes Logstash Pipelines used by Central Management
     *
     * $params['id'] = (string) The ID of the Pipeline
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/logstash-api-delete-pipeline.html
     */
    public function deletePipeline(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Logstash\DeletePipeline $endpoint */
        $endpoint = $endpointBuilder('Logstash\DeletePipeline');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves Logstash Pipelines used by Central Management
     *
     * $params['id'] = (string) A comma-separated list of Pipeline IDs
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/logstash-api-get-pipeline.html
     */
    public function getPipeline(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Logstash\GetPipeline $endpoint */
        $endpoint = $endpointBuilder('Logstash\GetPipeline');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Adds and updates Logstash Pipelines used for Central Management
     *
     * $params['id']   = (string) The ID of the Pipeline
     * $params['body'] = (array) The Pipeline to add or update (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/logstash-api-put-pipeline.html
     */
    public function putPipeline(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Logstash\PutPipeline $endpoint */
        $endpoint = $endpointBuilder('Logstash\PutPipeline');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}