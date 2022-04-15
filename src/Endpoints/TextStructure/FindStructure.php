<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:20:38
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\TextStructure;

use LavaMusic\ElasticSearch\Common\Exceptions\InvalidArgumentException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;
use LavaMusic\ElasticSearch\Serializers\SerializerInterface;
use Traversable;

/**
 * Class FindStructure
 * Elasticsearch API name text_structure.find_structure
 */
class FindStructure extends AbstractEndpoint
{
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getURI(): string
    {
        return "/_text_structure/find_structure";
    }

    public function getParamWhitelist(): array
    {
        return [
            'lines_to_sample',
            'line_merge_size_limit',
            'timeout',
            'charset',
            'format',
            'has_header_row',
            'column_names',
            'delimiter',
            'quote',
            'should_trim_fields',
            'grok_pattern',
            'timestamp_field',
            'timestamp_format',
            'explain'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): FindStructure
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