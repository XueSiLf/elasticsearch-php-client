<?php
/**
 * Created by PhpStorm.
 * User: XueSi <1592328848@qq.com>
 * Date: 2022/4/11
 * Time: 9:24 下午
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Common\Exceptions;

/**
 * Class ClientErrorResponseException
 */
class ClientErrorResponseException extends TransportException implements ElasticsearchException
{
}