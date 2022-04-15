<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:19:57
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Ssl;

/**
 * Class SslNamespace
 */
class SslNamespace extends AbstractNamespace
{
    /**
     * Retrieves information about the X.509 certificates used to encrypt communications in the cluster.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-ssl.html
     */
    public function certificates(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ssl\Certificates $endpoint */
        $endpoint = $endpointBuilder('Ssl\Certificates');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}
