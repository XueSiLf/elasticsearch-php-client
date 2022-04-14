<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:12:37
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Common\Exceptions\Missing404Exception;
use LavaMusic\ElasticSearch\Common\Exceptions\RoutingMissingException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;
use LavaMusic\ElasticSearch\Transport;

abstract class BooleanRequestWrapper
{
    /**
     * Perform Request
     *
     * @param AbstractEndpoint $endpoint
     * @param Transport $transport
     * @return false|mixed
     * @throws \LavaMusic\ElasticSearch\Common\Exceptions\NoNodesAvailableException
     */
    public static function performRequest(AbstractEndpoint $endpoint, Transport $transport)
    {
        try {
            $response = $transport->performRequest(
                $endpoint->getMethod(),
                $endpoint->getURI(),
                $endpoint->getParams(),
                $endpoint->getBody(),
                $endpoint->getOptions()
            );
        } catch (Missing404Exception $exception) {
            return false;
        } catch (RoutingMissingException $exception) {
            return false;
        }

        return $response;
    }
}
