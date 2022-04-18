<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:35:20
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Serializers;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

if (!defined('JSON_INVALID_UTF8_SUBSTITUTE')) {
    //PHP < 7.2 Define it as 0 so it does nothing
    define('JSON_INVALID_UTF8_SUBSTITUTE', 0);
}

class EverythingToJSONSerializer implements SerializerInterface
{
    /**
     * {@inheritdoc}
     */
    public function serialize($data): string
    {
        $data = json_encode($data, JSON_PRESERVE_ZERO_FRACTION + JSON_INVALID_UTF8_SUBSTITUTE);
        if ($data === false) {
            throw new RuntimeException("Failed to JSON encode: ".json_last_error());
        }
        if ($data === '[]') {
            return '{}';
        } else {
            return $data;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize(?string $data, array $headers)
    {
        return json_decode($data, true);
    }
}