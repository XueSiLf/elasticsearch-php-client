<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:35:45
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Xpack;

/**
 * Class XpackNamespace
 */
class XpackNamespace extends AbstractNamespace
{
    /**
     * Retrieves information about the installed X-Pack features.
     *
     * $params['categories']        = (list) Comma-separated list of info categories. Can be any of: build, license, features
     * $params['accept_enterprise'] = (boolean) If an enterprise license is installed, return the type and mode as 'enterprise' (default: false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/info-api.html
     */
    public function info(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Xpack\Info $endpoint */
        $endpoint = $endpointBuilder('Xpack\Info');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves usage information about the installed X-Pack features.
     *
     * $params['master_timeout'] = (time) Specify timeout for watch write operation
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/usage-api.html
     */
    public function usage(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Xpack\Usage $endpoint */
        $endpoint = $endpointBuilder('Xpack\Usage');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}