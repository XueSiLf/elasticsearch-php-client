<?php
/**
 * Created by PhpStorm.
 * User: XueSi <1592328848@qq.com>
 * Date: 2022/4/11
 * Time: 9:21 下午
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Common\Exceptions;

/**
 * BadMethodCallException
 *
 * Denote problems with a method call (e.g. incorrect number of arguments)
 */
class BadMethodCallException extends \BadMethodCallException implements ElasticsearchException
{
}