<?php
/**
 * Created by PhpStorm.
 * Author: 黄龙辉 XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 9:55:26
 */

namespace LavaMusic\ElasticSearch\Common;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class EmptyLogger
 *
 * Logger that doesn't do anything.  Similar to Monolog's NullHandler,
 * but avoids the overhead of partially loading Monolog
 */
class EmptyLogger extends AbstractLogger implements LoggerInterface
{
    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = []): void
    {
        return;
    }
}
