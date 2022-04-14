<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 17:40:17
 */

namespace LavaMusic\ElasticSearch\Tests;

use LavaMusic\ElasticSearch\Client;
use LavaMusic\ElasticSearch\ClientBuilder;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    /** @var Client */
    protected $client;

    /** @var array */
    protected $config;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->config = require_once __DIR__ . '/Config/server.php';
    }

    public function createClient(string $scheme = 'http', bool $isXPack = false)
    {
        $xPack = $isXPack ? 'x-pack' : 'not-x-pack';
        $configs = $this->config[$scheme][$xPack];
        $this->client = ClientBuilder::create()
            ->setHosts($configs['hosts'])
            ->build();
        return $this->client;
    }
}