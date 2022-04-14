<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 16:43:50
 */

namespace LavaMusic\ElasticSearch\Handler\Exceptions;

use LavaMusic\ElasticSearch\Common\Exceptions\ElasticsearchException;
use Throwable;

class SwooleRequestException extends \Exception implements ElasticsearchException
{
    public function __construct(int $errno, string $error, Throwable $previous = null)
    {
        $message = sprintf("errno:%s,error:%s,See ```https://wiki.swoole.com/#/coroutine_client/http_client?id=errcode``` for details on error code.", $errno, $error);
        $code = 0;
        parent::__construct($message, $code, $previous);
    }
}