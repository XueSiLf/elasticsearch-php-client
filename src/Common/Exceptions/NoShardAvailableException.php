<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 17:12:22
 */

namespace LavaMusic\ElasticSearch\Common\Exceptions;

class NoShardAvailableException extends ServerErrorResponseException implements ElasticsearchException
{
}