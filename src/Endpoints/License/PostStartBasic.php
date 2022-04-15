<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:44:03
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\License;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PostStartBasic
 * Elasticsearch API name license.post_start_basic
 */
class PostStartBasic extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_license/start_basic";
    }

    public function getParamWhitelist(): array
    {
        return [
            'acknowledge'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}