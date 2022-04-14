<?php
/**
 * Created by PhpStorm.
 * User: XueSi <1592328848@qq.com>
 * Date: 2022/4/11
 * Time: 9:34 下午
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Common\Exceptions;

/**
 * Class MaxRetriesException
 */
class MaxRetriesException extends TransportException implements ElasticsearchException
{
}