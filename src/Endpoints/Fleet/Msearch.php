<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:41:28
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Fleet;

use LavaMusic\ElasticSearch\Common\Exceptions\InvalidArgumentException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;
use LavaMusic\ElasticSearch\Serializers\SerializerInterface;
use Traversable;

/**
 * Class Msearch
 * Elasticsearch API name fleet.msearch
 */
class Msearch extends AbstractEndpoint
{
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_fleet/_fleet_msearch";
        }
        return "/_fleet/_fleet_msearch";
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): Msearch
    {
        if (isset($body) !== true) {
            return $this;
        }
        if (is_array($body) === true || $body instanceof Traversable) {
            foreach ($body as $item) {
                $this->body .= $this->serializer->serialize($item) . "\n";
            }
        } elseif (is_string($body)) {
            $this->body = $body;
            if (substr($body, -1) != "\n") {
                $this->body .= "\n";
            }
        } else {
            throw new InvalidArgumentException("Body must be an array, traversable object or string");
        }
        return $this;
    }
}