<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 17:54:32
 */
/**
 * Elasticsearch PHP Client
 *
 * @link      https://github.com/elastic/elasticsearch-php
 * @copyright Copyright (c) Elasticsearch B.V (https://www.elastic.co)
 *
 * Licensed to Elasticsearch B.V under one or more agreements.
 * Elasticsearch B.V licenses this file to you under the MIT License.
 * See the LICENSE file in the project root for more information.
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Tests;

use LavaMusic\ElasticSearch\Client;
use LavaMusic\ElasticSearch\Common\Exceptions\InvalidArgumentException;
use LavaMusic\ElasticSearch\ClientBuilder;
use LavaMusic\ElasticSearch\Common\Exceptions\MaxRetriesException;
use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Common\Exceptions\TransportException;
use LavaMusic\ElasticSearch\Handler\Exceptions\ConnectException;
use LavaMusic\ElasticSearch\Handler\Exceptions\SwooleRequestException;

/**
 * Class ClientTest
 * @package LavaMusic\ElasticSearch\Tests
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/19 9:29:28
 */
class ClientTest extends BaseTestCase
{
    public function testConstructorIllegalPort()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Could not parse URI');

        $client = ClientBuilder::create()->setHosts(['localhost:abc'])->build();
    }

    public function testFromConfig()
    {
        $params = [
            'hosts' => [
                'localhost:9200'
            ],
            'retries' => 2,
            'handler' => ClientBuilder::singleHandler()
        ];
        $client = ClientBuilder::fromConfig($params);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testFromConfigBadParam()
    {
        $params = [
            'hosts' => [
                'localhost:9200'
            ],
            'retries' => 2,
            'imNotReal' => 5
        ];

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unknown parameters provided: imNotReal');

        $client = ClientBuilder::fromConfig($params);
    }

    public function testFromConfigBadParamQuiet()
    {
        $params = [
            'hosts' => [
                'localhost:9200'
            ],
            'retries' => 2,
            'imNotReal' => 5
        ];
        $client = ClientBuilder::fromConfig($params, true);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testIndexCannotBeNullForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('index is required for delete');

        $client->delete(
            [
                'index' => null,
                'type' => 'test',
                'id' => 'test'
            ]
        );
    }

    public function testIdCannotBeNullForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('id is required for delete');

        $client->delete(
            [
                'index' => 'test',
                'id' => null
            ]
        );
    }

    public function testMaxRetriesException()
    {
        $client = ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->setRetries(0)
            ->build();

        $searchParams = [
            'index' => 'test',
            'type' => 'test',
            'body' => [
                'query' => [
                    'match_all' => []
                ]
            ]
        ];

        $client = ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->setRetries(0)
            ->build();

        try {
            $client->search($searchParams);
            $this->fail("Should have thrown SwooleRequestException");
        } catch (SwooleRequestException $e) {
            // All good
            $previous = $e->getPrevious();
            $this->assertInstanceOf(MaxRetriesException::class, $previous);
        } catch (\Exception $e) {
            throw $e;
        }


        $client = ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->setRetries(0)
            ->build();

        try {
            $client->search($searchParams);
            $this->fail("Should have thrown Exception");
        } catch (\Exception $e) {
            // All good
            $previous = $e->getPrevious();
            $this->assertInstanceOf(MaxRetriesException::class, $previous);
        }
    }

    public function testInlineHosts()
    {
        $client = ClientBuilder::create()->setHosts(
            [
                'localhost:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("localhost", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());


        $client = ClientBuilder::create()->setHosts(
            [
                'http://localhost:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("localhost", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());

        $client = ClientBuilder::create()->setHosts(
            [
                'http://foo.com:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());

        $client = ClientBuilder::create()->setHosts(
            [
                'https://foo.com:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("https", $host->getTransportSchema());


        $client = ClientBuilder::create()->setHosts(
            [
                'https://user:pass@foo.com:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("https", $host->getTransportSchema());
        $this->assertSame("user:pass", $host->getUserPass());

        $client = ClientBuilder::create()->setHosts(
            [
                'https://user:pass@the_foo.com:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("the_foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("https", $host->getTransportSchema());
        $this->assertSame("user:pass", $host->getUserPass());
    }


    public function testExtendedHosts()
    {
        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'localhost',
                    'port' => 9200,
                    'scheme' => 'http'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("localhost", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());


        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'foo.com',
                    'port' => 9200,
                    'scheme' => 'http'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());


        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'foo.com',
                    'port' => 9200,
                    'scheme' => 'https'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("https", $host->getTransportSchema());


        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'foo.com',
                    'scheme' => 'http'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());


        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'foo.com'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());


        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'foo.com',
                    'port' => 9500,
                    'scheme' => 'https'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9500, $host->getPort());
        $this->assertSame("https", $host->getTransportSchema());


        try {
            $client = ClientBuilder::create()->setHosts(
                [
                    [
                        'port' => 9200,
                        'scheme' => 'http'
                    ]
                ]
            )->build();
            $this->fail("Expected RuntimeException from missing host, none thrown");
        } catch (RuntimeException $e) {
            // good
        }

        // Underscore host, questionably legal
        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'the_foo.com'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("the_foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());


        // Special characters in user/pass, would break inline
        $client = ClientBuilder::create()->setHosts(
            [
                [
                    'host' => 'foo.com',
                    'user' => 'user',
                    'pass' => 'abc#$@?%!abc'
                ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com", $host->getHost());
        $this->assertSame(9200, $host->getPort());
        $this->assertSame("http", $host->getTransportSchema());
        $this->assertSame("user:abc#$@?%!abc", $host->getUserPass());
    }

    public function testInfo()
    {
        $client = ClientBuilder::create()->build();
        $response = $client->info();
        $this->assertNotEmpty($response['name']);
        $this->assertNotEmpty($response['cluster_name']);
        $this->assertNotEmpty($response['cluster_uuid']);
        $this->assertNotEmpty($response['version']);
        $this->assertNotEmpty($response['version']['number']);
    }

    public function testExtractArgumentIterable()
    {
        $client = ClientBuilder::create()->build();
        // array iterator can be casted to array back, so make more real with IteratorIterator
        $body = new \IteratorIterator(new \ArrayIterator([1, 2, 3]));
        $params = ['body' => $body];
        $argument = $client->extractArgument($params, 'body');
        $this->assertEquals($body, $argument);
        $this->assertCount(0, $params);
        $this->assertInstanceOf(\IteratorIterator::class, $argument);
    }
}