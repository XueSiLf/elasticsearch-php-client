<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/19 10:22:55
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Tests\Serializers;

use LavaMusic\ElasticSearch\Common\Exceptions\Serializer\JsonErrorException;
use LavaMusic\ElasticSearch\Serializers\SmartSerializer;
use LavaMusic\ElasticSearch\Tests\BaseTestCase;

class SmartSerializerTest extends BaseTestCase
{
    protected $serializer;

    public function setUp(): void
    {
        $this->serializer = new SmartSerializer();
    }

    /**
     * @requires PHP 7.3
     * @see https://github.com/elastic/elasticsearch-php/issues/1012
     */
    public function testThrowJsonErrorException()
    {
        $this->expectException(JsonErrorException::class);
        $this->expectExceptionCode(JSON_ERROR_SYNTAX);

        $result = $this->serializer->deserialize('{ "foo" : bar" }', []);
    }

    /**
     * Single unpaired UTF-16 surrogate in unicode escape
     *
     * @requires PHP 7.3
     * @see https://github.com/elastic/elasticsearch-php/issues/1171
     */
    public function testSingleUnpairedUTF16SurrogateInUnicodeEscape()
    {
        $json = '{ "data": "ud83d\ude4f" }';

        $result = $this->serializer->deserialize($json, []);
        $this->assertEquals($result['data'], 'ud83d\ude4f');
    }
}