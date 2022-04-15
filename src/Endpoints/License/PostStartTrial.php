<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 10:44:25
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\License;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class PostStartTrial
 * Elasticsearch API name license.post_start_trial
 */
class PostStartTrial extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_license/start_trial";
    }

    public function getParamWhitelist(): array
    {
        return [
            'type',
            'acknowledge'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}