<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:26:06
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\DataFrameTransformDeprecated;

/**
 * Class DataFrameTransformDeprecatedNamespace
 */
class DataFrameTransformDeprecatedNamespace extends AbstractNamespace
{
    /**
     * Deletes an existing transform.
     *
     * $params['transform_id'] = (string) The id of the transform to delete
     * $params['force']        = (boolean) When `true`, the transform is deleted regardless of its current state. The default value is `false`, meaning that the transform must be `stopped` before it can be deleted.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/delete-transform.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function deleteTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\DeleteTransform $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\DeleteTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves configuration information for transforms.
     *
     * $params['transform_id']      = (string) The id or comma delimited list of id expressions of the transforms to get, '_all' or '*' implies get all transforms
     * $params['from']              = (int) skips a number of transform configs, defaults to 0
     * $params['size']              = (int) specifies a max number of transforms to get, defaults to 100
     * $params['allow_no_match']    = (boolean) Whether to ignore if a wildcard expression matches no transforms. (This includes `_all` string or when no transforms have been specified)
     * $params['exclude_generated'] = (boolean) Omits generated fields. Allows transform configurations to be easily copied between clusters and within the same cluster (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-transform.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function getTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\GetTransform $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\GetTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves usage information for transforms.
     *
     * $params['transform_id']   = (string) The id of the transform for which to get stats. '_all' or '*' implies all transforms
     * $params['from']           = (number) skips a number of transform stats, defaults to 0
     * $params['size']           = (number) specifies a max number of transform stats to get, defaults to 100
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no transforms. (This includes `_all` string or when no transforms have been specified)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-transform-stats.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function getTransformStats(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\GetTransformStats $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\GetTransformStats');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Previews a transform.
     *
     * $params['body'] = (array) The definition for the transform to preview (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/preview-transform.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function previewTransform(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\PreviewTransform $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\PreviewTransform');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Instantiates a transform.
     *
     * $params['transform_id']     = (string) The id of the new transform.
     * $params['defer_validation'] = (boolean) If validations should be deferred until transform starts, defaults to false.
     * $params['body']             = (array) The transform definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/put-transform.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function putTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\PutTransform $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\PutTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Starts one or more transforms.
     *
     * $params['transform_id'] = (string) The id of the transform to start
     * $params['timeout']      = (time) Controls the time to wait for the transform to start
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/start-transform.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function startTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\StartTransform $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\StartTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Stops one or more transforms.
     *
     * $params['transform_id']        = (string) The id of the transform to stop
     * $params['wait_for_completion'] = (boolean) Whether to wait for the transform to fully stop before returning or not. Default to false
     * $params['timeout']             = (time) Controls the time to wait until the transform has stopped. Default to 30 seconds
     * $params['allow_no_match']      = (boolean) Whether to ignore if a wildcard expression matches no transforms. (This includes `_all` string or when no transforms have been specified)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/stop-transform.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function stopTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\StopTransform $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\StopTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates certain properties of a transform.
     *
     * $params['transform_id']     = (string) The id of the transform.
     * $params['defer_validation'] = (boolean) If validations should be deferred until transform starts, defaults to false.
     * $params['body']             = (array) The update transform definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/update-transform.html
     *
     * @note This API is BETA and may change in ways that are not backwards compatible
     *
     */
    public function updateTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var DataFrameTransformDeprecated\UpdateTransform $endpoint */
        $endpoint = $endpointBuilder('DataFrameTransformDeprecated\UpdateTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}
