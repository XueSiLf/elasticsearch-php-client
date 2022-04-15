<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/3/4 11:31:51
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Connections;

use LavaMusic\ElasticSearch\Serializers\SerializerInterface;
use Psr\Log\LoggerInterface;

class ConnectionFactory implements ConnectionFactoryInterface
{
    /**
     * @var array
     */
    private $connectionParams;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var LoggerInterface
     */
    private $tracer;

    /**
     * @var callable
     */
    private $handler;

    public function __construct(callable $handler, array $connectionParams, SerializerInterface $serializer, LoggerInterface $logger, LoggerInterface $tracer)
    {
        $this->handler          = $handler;
        $this->connectionParams = $connectionParams;
        $this->logger           = $logger;
        $this->tracer           = $tracer;
        $this->serializer       = $serializer;
    }

    public function create(array $hostDetails): ConnectionInterface
    {
        return new Connection(
            $this->handler,
            $hostDetails,
            $this->connectionParams,
            $this->serializer,
            $this->logger,
            $this->tracer
        );
    }
}
