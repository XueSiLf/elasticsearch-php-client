<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:40:00
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Ingest;

/**
 * Class IngestNamespace
 */
class IngestNamespace extends AbstractNamespace
{
    /**
     * Deletes a pipeline.
     *
     * $params['id']             = (string) Pipeline ID
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['timeout']        = (time) Explicit operation timeout
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/delete-pipeline-api.html
     */
    public function deletePipeline(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Ingest\DeletePipeline $endpoint */
        $endpoint = $endpointBuilder('Ingest\DeletePipeline');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns statistical information about geoip databases
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/geoip-stats-api.html
     */
    public function geoIpStats(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ingest\GeoIpStats $endpoint */
        $endpoint = $endpointBuilder('Ingest\GeoIpStats');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns a pipeline.
     *
     * $params['id']             = (string) Comma separated list of pipeline ids. Wildcards supported
     * $params['summary']        = (boolean) Return pipelines without their definitions (default: false)
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/get-pipeline-api.html
     */
    public function getPipeline(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Ingest\GetPipeline $endpoint */
        $endpoint = $endpointBuilder('Ingest\GetPipeline');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns a list of the built-in patterns.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/grok-processor.html#grok-processor-rest-get
     */
    public function processorGrok(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ingest\ProcessorGrok $endpoint */
        $endpoint = $endpointBuilder('Ingest\ProcessorGrok');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates or updates a pipeline.
     *
     * $params['id']             = (string) Pipeline ID
     * $params['if_version']     = (int) Required version for optimistic concurrency control for pipeline updates
     * $params['master_timeout'] = (time) Explicit operation timeout for connection to master node
     * $params['timeout']        = (time) Explicit operation timeout
     * $params['body']           = (array) The ingest definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/put-pipeline-api.html
     */
    public function putPipeline(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ingest\PutPipeline $endpoint */
        $endpoint = $endpointBuilder('Ingest\PutPipeline');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Allows to simulate a pipeline with example documents.
     *
     * $params['id']      = (string) Pipeline ID
     * $params['verbose'] = (boolean) Verbose mode. Display data output for each processor in executed pipeline (Default = false)
     * $params['body']    = (array) The simulate definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/master/simulate-pipeline-api.html
     */
    public function simulate(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ingest\Simulate $endpoint */
        $endpoint = $endpointBuilder('Ingest\Simulate');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}