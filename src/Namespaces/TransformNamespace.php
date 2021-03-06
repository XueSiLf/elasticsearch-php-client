<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:26:50
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Transform;

/**
 * Class TransformNamespace
 */
class TransformNamespace extends AbstractNamespace
{
    /**
     * Deletes an existing transform.
     *
     * $params['transform_id'] = (string) The id of the transform to delete
     * $params['force']        = (boolean) When `true`, the transform is deleted regardless of its current state. The default value is `false`, meaning that the transform must be `stopped` before it can be deleted.
     * $params['timeout']      = (time) Controls the time to wait for the transform deletion
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/delete-transform.html
     */
    public function deleteTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\DeleteTransform $endpoint */
        $endpoint = $endpointBuilder('Transform\DeleteTransform');
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
     * $params['exclude_generated'] = (boolean) Omits fields that are illegal to set on transform PUT (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-transform.html
     */
    public function getTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\GetTransform $endpoint */
        $endpoint = $endpointBuilder('Transform\GetTransform');
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
     */
    public function getTransformStats(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\GetTransformStats $endpoint */
        $endpoint = $endpointBuilder('Transform\GetTransformStats');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Previews a transform.
     *
     * $params['transform_id'] = (string) The id of the transform to preview.
     * $params['timeout']      = (time) Controls the time to wait for the preview
     * $params['body']         = (array) The definition for the transform to preview
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/preview-transform.html
     */
    public function previewTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\PreviewTransform $endpoint */
        $endpoint = $endpointBuilder('Transform\PreviewTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Instantiates a transform.
     *
     * $params['transform_id']     = (string) The id of the new transform.
     * $params['defer_validation'] = (boolean) If validations should be deferred until transform starts, defaults to false.
     * $params['timeout']          = (time) Controls the time to wait for the transform to start
     * $params['body']             = (array) The transform definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/put-transform.html
     */
    public function putTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\PutTransform $endpoint */
        $endpoint = $endpointBuilder('Transform\PutTransform');
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
     */
    public function startTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\StartTransform $endpoint */
        $endpoint = $endpointBuilder('Transform\StartTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Stops one or more transforms.
     *
     * $params['transform_id']        = (string) The id of the transform to stop
     * $params['force']               = (boolean) Whether to force stop a failed transform or not. Default to false
     * $params['wait_for_completion'] = (boolean) Whether to wait for the transform to fully stop before returning or not. Default to false
     * $params['timeout']             = (time) Controls the time to wait until the transform has stopped. Default to 30 seconds
     * $params['allow_no_match']      = (boolean) Whether to ignore if a wildcard expression matches no transforms. (This includes `_all` string or when no transforms have been specified)
     * $params['wait_for_checkpoint'] = (boolean) Whether to wait for the transform to reach a checkpoint before stopping. Default to false
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/stop-transform.html
     */
    public function stopTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\StopTransform $endpoint */
        $endpoint = $endpointBuilder('Transform\StopTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates certain properties of a transform.
     *
     * $params['transform_id']     = (string) The id of the transform.
     * $params['defer_validation'] = (boolean) If validations should be deferred until transform starts, defaults to false.
     * $params['timeout']          = (time) Controls the time to wait for the update
     * $params['body']             = (array) The update transform definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/update-transform.html
     */
    public function updateTransform(array $params = [])
    {
        $transform_id = $this->extractArgument($params, 'transform_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Transform\UpdateTransform $endpoint */
        $endpoint = $endpointBuilder('Transform\UpdateTransform');
        $endpoint->setParams($params);
        $endpoint->setTransformId($transform_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Upgrades all transforms.
     *
     * $params['dry_run'] = (boolean) Whether to only check for updates but don't execute
     * $params['timeout'] = (time) Controls the time to wait for the upgrade
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/upgrade-transforms.html
     */
    public function upgradeTransforms(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Transform\UpgradeTransforms $endpoint */
        $endpoint = $endpointBuilder('Transform\UpgradeTransforms');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}