Elasticsearch-PHP-client
========================

[![Latest Stable Version](https://poser.pugx.org/elasticsearch/elasticsearch/v/stable)](https://packagist.org/packages/lavamusic/elasticsearch-php-client) [![Total Downloads](https://poser.pugx.org/elasticsearch/elasticsearch/downloads)](https://packagist.org/packages/lavamusic/elasticsearch-php-client)

This is the PHP client for [Elasticsearch](https://www.elastic.co/elasticsearch/), which is implemented with reference to [the official PHP client of Elasticsearch](https://github.com/elastic/elasticsearch-php).

The main purpose of this component is to facilitate users to operate es in the swoole related frameworks.

The cURL request driver layer is implemented using the swoole coroutine client. You can use it in swoole related frameworks (eg: EasySwoole, Hyperf, Swoft, IMIPHP, Mix-PHP, etc.).

## Contents
- [Getting started](#getting-started-)
- [License](#license-)

***

## Getting started 🐣

Using this client assumes that you have an [Elasticsearch](https://www.elastic.co/elasticsearch/)
server  installed and running.

You can install the client in your PHP project using [composer](https://getcomposer.org/):

```bash
composer require lavamusic/elasticsearch-php-client "dev-main"
```

After the installation you can connect to Elasticsearch using the `ClientBuilder`
class. For instance, if your Elasticsearch is running on `localhost:9200`
you can use the following code:

```php
<?php

use LavaMusic\Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()
    ->setHosts(['localhost:9200'])
    ->build();

// Info API
$response = $client->info();

echo $response['version']['number']; // 7.10.1
```

## License 📗
Apache License 2.0
