<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 17:40:17
 */

namespace LavaMusic\ElasticSearch\Tests;

define('ELASTICSEARCH_SERVER_HOST', 'localhost');
define('ELASTICSEARCH_SERVER_PORT', 9200);

use LavaMusic\ElasticSearch\Client;
use LavaMusic\ElasticSearch\ClientBuilder;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    /** @var Client */
    protected $client;

    public function createClient(string $scheme = 'http')
    {
        $hosts = [
            $scheme . '://' . ELASTICSEARCH_SERVER_HOST . ':' . ELASTICSEARCH_SERVER_PORT,
        ];
        $this->client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();
        return $this->client;
    }
}