<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/19 10:22:21
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Tests\Serializers;

use LavaMusic\ElasticSearch\Serializers\EverythingToJSONSerializer;
use LavaMusic\ElasticSearch\Tests\BaseTestCase;

class EverythingToJSONSerializerTest extends BaseTestCase
{
    public function testSerializeArray()
    {
        $serializer = new EverythingToJSONSerializer();
        $body = ['value' => 'field'];

        $ret = $serializer->serialize($body);

        $body = json_encode($body, JSON_PRESERVE_ZERO_FRACTION);
        $this->assertSame($body, $ret);
    }

    public function testSerializeString()
    {
        $serializer = new EverythingToJSONSerializer();
        $body = 'abc';

        $ret = $serializer->serialize($body);

        $body = '"abc"';
        $this->assertSame($body, $ret);
    }

    public function testDeserializeJSON()
    {
        $serializer = new EverythingToJSONSerializer();
        $body = '{"field":"value"}';

        $ret = $serializer->deserialize($body, []);

        $body = json_decode($body, true);
        $this->assertSame($body, $ret);
    }
}