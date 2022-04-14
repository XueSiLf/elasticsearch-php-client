<?php
/**
 * Created by PhpStorm.
 * User: XueSi <1592328848@qq.com>
 * Date: 2022/4/11
 * Time: 9:41 下午
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Serializers;

interface SerializerInterface
{
    /**
     * Serialize a complex data-structure into a json encoded string
     *
     * @param  mixed $data The data to encode
     * @return string
     */
    public function serialize($data): string;

    /**
     * Deserialize json encoded string into an associative array
     *
     * @param  string $data    JSON encoded string
     * @param  array  $headers Response Headers
     * @return string|array
     */
    public function deserialize(?string $data, array $headers);
}