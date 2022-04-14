<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 18:58:54
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints;

/**
 * Class AutoscalingNamespace
 */
class AutoscalingNamespace extends AbstractNamespace
{
    /**
     * Deletes an autoscaling policy. Designed for indirect use by ECE/ESS and ECK. Direct use is not supported.
     *
     * $params['name'] = (string) the name of the autoscaling policy
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/autoscaling-delete-autoscaling-policy.html
     */
    public function deleteAutoscalingPolicy(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Autoscaling\DeleteAutoscalingPolicy $endpoint */
        $endpoint = $endpointBuilder('Autoscaling\DeleteAutoscalingPolicy');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets the current autoscaling capacity based on the configured autoscaling policy. Designed for indirect use by ECE/ESS and ECK. Direct use is not supported.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/autoscaling-get-autoscaling-capacity.html
     */
    public function getAutoscalingCapacity(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Autoscaling\GetAutoscalingCapacity $endpoint */
        $endpoint = $endpointBuilder('Autoscaling\GetAutoscalingCapacity');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves an autoscaling policy. Designed for indirect use by ECE/ESS and ECK. Direct use is not supported.
     *
     * $params['name'] = (string) the name of the autoscaling policy
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/autoscaling-get-autoscaling-policy.html
     */
    public function getAutoscalingPolicy(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Autoscaling\GetAutoscalingPolicy $endpoint */
        $endpoint = $endpointBuilder('Autoscaling\GetAutoscalingPolicy');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a new autoscaling policy. Designed for indirect use by ECE/ESS and ECK. Direct use is not supported.
     *
     * $params['name'] = (string) the name of the autoscaling policy
     * $params['body'] = (array) the specification of the autoscaling policy (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/autoscaling-put-autoscaling-policy.html
     */
    public function putAutoscalingPolicy(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Endpoints\Autoscaling\PutAutoscalingPolicy $endpoint */
        $endpoint = $endpointBuilder('Autoscaling\PutAutoscalingPolicy');
        $endpoint->setParams($params);
        $endpoint->setName($name);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}