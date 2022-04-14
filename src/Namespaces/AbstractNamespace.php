<?php
/**
 * Created by PhpStorm.
 * Author: XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/3/4 11:31:51
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;
use LavaMusic\ElasticSearch\Transport;

abstract class AbstractNamespace
{
    /**
     * @var Transport
     */
    protected $transport;

    /**
     * @var callable
     */
    protected $endpoints;

    public function __construct(Transport $transport, callable $endpoints)
    {
        $this->transport = $transport;
        $this->endpoints = $endpoints;
    }

    /**
     * @return null|mixed
     */
    public function extractArgument(array &$params, string $arg)
    {
        if (array_key_exists($arg, $params) === true) {
            $val = $params[$arg];
            unset($params[$arg]);
            return $val;
        } else {
            return null;
        }
    }

    protected function performRequest(AbstractEndpoint $endpoint)
    {
        return $this->transport->performRequest(
            $endpoint->getMethod(),
            $endpoint->getURI(),
            $endpoint->getParams(),
            $endpoint->getBody(),
            $endpoint->getOptions()
        );
    }
}
