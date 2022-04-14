<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 17:12:38
 */

namespace LavaMusic\ElasticSearch\Common\Exceptions;

class RequestTimeout408Exception extends BadRequest400Exception implements ElasticsearchException
{
}