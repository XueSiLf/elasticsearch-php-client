<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/19 9:53:49
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Tests;

use LavaMusic\ElasticSearch\Client;
use LavaMusic\ElasticSearch\ClientBuilder;
use LavaMusic\ElasticSearch\Common\Exceptions\ElasticsearchException;
use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Tests\ClientBuilder\DummyLogger;

class ClientBuilderTest extends BaseTestCase
{
    public function testClientBuilderThrowsExceptionForIncorrectLoggerClass()
    {
        $this->expectException(\TypeError::class);
        ClientBuilder::create()->setLogger(new DummyLogger());
    }

    public function testClientBuilderThrowsExceptionForIncorrectTracerClass()
    {
        $this->expectException(\TypeError::class);
        ClientBuilder::create()->setTracer(new DummyLogger());
    }

    public function testGzipEnabledWhenElasticCloudId()
    {
        $client = ClientBuilder::create()
            ->setElasticCloudId('foo:' . base64_encode('localhost:9200$foo'))
            ->build();

        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertContains('gzip', $request['request']['client']['swoole']);
        }
    }

    public function testElasticCloudIdNotOverrideCurlEncoding()
    {
        $params = [
            'client' => [
                'swoole' => [
                    'encoding' => 'deflate'
                ]
            ]
        ];
        $client = ClientBuilder::create()
            ->setConnectionParams($params)
            ->setElasticCloudId('foo:' . base64_encode('localhost:9200$foo'))
            ->build();

        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertContains('deflate', $request['request']['client']['swoole']);
            $this->assertNotContains('gzip', $request['request']['client']['swoole']);
        }
    }

    public function testIncludePortInHostHeader()
    {
        $host = "localhost";
        $url = "$host:1234";
        $params = [
            'client' => [
                'verbose' => true
            ]
        ];
        $client = ClientBuilder::create()
            ->setConnectionParams($params)
            ->setHosts([$url])
            ->includePortInHostHeader(true)
            ->build();

        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['Host'][0]));
            $this->assertEquals($url, $request['request']['headers']['Host'][0]);
        }
    }

    public function testNotIncludePortInHostHeaderAsDefault()
    {
        $host = "localhost";
        $url  = "$host:1234";
        $params = [
            'client' => [
                'verbose' => true
            ]
        ];
        $client = ClientBuilder::create()
            ->setConnectionParams($params)
            ->setHosts([$url])
            ->build();

        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['Host'][0]));
            $this->assertEquals($host, $request['request']['headers']['Host'][0]);
        }
    }

    public function testNotIncludePortInHostHeader()
    {
        $host = "localhost";
        $url  = "$host:1234";
        $params = [
            'client' => [
                'verbose' => true
            ]
        ];
        $client = ClientBuilder::create()
            ->setConnectionParams($params)
            ->setHosts([$url])
            ->includePortInHostHeader(false)
            ->build();

        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['Host'][0]));
            $this->assertEquals($host, $request['request']['headers']['Host'][0]);
        }
    }

    public function getCloudIdExamples()
    {
        return [
            ['cluster:d2VzdGV1cm9wZS5henVyZS5lbGFzdGljLWNsb3VkLmNvbTo5MjQzJGM2NjM3ZjMxMmM1MjQzY2RhN2RlZDZlOTllM2QyYzE5JA==', 'c6637f312c5243cda7ded6e99e3d2c19.westeurope.azure.elastic-cloud.com:9243'],
            ['cluster:d2VzdGV1cm9wZS5henVyZS5lbGFzdGljLWNsb3VkLmNvbSRlN2RlOWYxMzQ1ZTQ0OTAyODNkOTAzYmU1YjZmOTE5ZSQ=', 'e7de9f1345e4490283d903be5b6f919e.westeurope.azure.elastic-cloud.com'],
            ['cluster:d2VzdGV1cm9wZS5henVyZS5lbGFzdGljLWNsb3VkLmNvbSQ4YWY3ZWUzNTQyMGY0NThlOTAzMDI2YjQwNjQwODFmMiQyMDA2MTU1NmM1NDA0OTg2YmZmOTU3ZDg0YTZlYjUxZg==', '8af7ee35420f458e903026b4064081f2.westeurope.azure.elastic-cloud.com']
        ];
    }

    /**
     * @dataProvider getCloudIdExamples
     */
    public function testSetCloudIdWithExplicitPortOnlyEsUuid(string $cloudId, string $url)
    {
        $client = ClientBuilder::create()
            ->setElasticCloudId($cloudId)
            ->build();

        $connection = $client->transport->getConnection();

        $this->assertEquals($url, $connection->getHost());
    }

    public function getConfig()
    {
        return [
            [[
                'hosts' => ['localhost:9200']
            ]],
            [[
                'hosts'  => ['cloud:9200'],
                'apiKey' => ['id-value', 'apikey-value']
            ]],
            [[
                'hosts'  => ['cloud:9200'],
                'basicAuthentication' => ['username-value', 'password-value']
            ]]
        ];
    }

    /**
     * @dataProvider getConfig
     * @see https://github.com/elastic/elasticsearch-php/issues/1074
     */
    public function testFromConfig(array $params)
    {
        $client = ClientBuilder::fromConfig($params);
        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFromConfigQuiteTrueWithUnknownKey()
    {
        $client = ClientBuilder::fromConfig(
            [
                'hosts' => ['localhost:9200'],
                'foo' => 'bar'
            ],
            true
        );
    }

    public function testFromConfigQuiteFalseWithUnknownKey()
    {
        $this->expectException(RuntimeException::class);
        $client = ClientBuilder::fromConfig(
            [
                'hosts' => ['localhost:9200'],
                'foo' => 'bar'
            ],
            false
        );
    }

    public function testElasticClientMetaHeaderIsSentByDefault()
    {
        $client = ClientBuilder::create()
            ->build();
        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['x-elastic-client-meta']));
            $this->assertEquals(
                1,
                preg_match(
                    '/^[a-z]{1,}=[a-z0-9\.\-]{1,}(?:,[a-z]{1,}=[a-z0-9\.\-]+)*$/',
                    $request['request']['headers']['x-elastic-client-meta'][0]
                )
            );
        }
    }

    public function testElasticClientMetaHeaderIsSentWhenEnabled()
    {
        $client = ClientBuilder::create()
            ->setElasticMetaHeader(true)
            ->build();
        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['x-elastic-client-meta']));
            $this->assertEquals(
                1,
                preg_match(
                    '/^[a-z]{1,}=[a-z0-9\.\-]{1,}(?:,[a-z]{1,}=[a-z0-9\.\-]+)*$/',
                    $request['request']['headers']['x-elastic-client-meta'][0]
                )
            );
        }
    }

    public function testElasticClientMetaHeaderIsNotSentWhenDisabled()
    {
        $client = ClientBuilder::create()
            ->setElasticMetaHeader(false)
            ->build();
        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertFalse(isset($request['request']['headers']['x-elastic-client-meta']));
        }
    }

    public function getCompatibilityHeaders()
    {
        return [
            ['true', true],
            ['1', true],
            ['false', false],
            ['0', false]
        ];
    }

    /**
     * @dataProvider getCompatibilityHeaders
     */
    public function testCompatibilityHeader($env, $compatibility)
    {
        $client = ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->setElasticClientApiVersioning($env)
            ->build();

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            if ($compatibility) {
                $this->assertContains('application/vnd.elasticsearch+json;compatible-with=7', $request['request']['headers']['Content-Type']);
                $this->assertContains('application/vnd.elasticsearch+json;compatible-with=7', $request['request']['headers']['Accept']);
            } else {
                $this->assertNotContains('application/vnd.elasticsearch+json;compatible-with=7', $request['request']['headers']['Content-Type']);
                $this->assertNotContains('application/vnd.elasticsearch+json;compatible-with=7', $request['request']['headers']['Accept']);
            }
        }
    }

    public function testCompatibilityHeaderDefaultIsOff()
    {
        $client = ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->build();

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertNotContains('application/vnd.elasticsearch+json;compatible-with=7', $request['request']['headers']['Content-Type']);
            $this->assertNotContains('application/vnd.elasticsearch+json;compatible-with=7', $request['request']['headers']['Accept']);
        }
    }

    public function testFromConfigWithIncludePortInHostHeader()
    {
        $url = 'localhost:1234';
        $config = [
            'hosts' => [$url],
            'includePortInHostHeader' => true,
            'connectionParams' => [
                'client' => [
                    'verbose' => true
                ]
            ],
        ];

        $client = ClientBuilder::fromConfig($config);

        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['Host'][0]));
            $this->assertEquals($url, $request['request']['headers']['Host'][0]);
        }
    }
}