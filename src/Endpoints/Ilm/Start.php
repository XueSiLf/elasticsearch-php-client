<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 9:20:13
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Ilm;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Start
 * Elasticsearch API name ilm.start
 */
class Start extends AbstractEndpoint
{
    public function getURI(): string
    {
        return "/_ilm/start";
    }

    public function getParamWhitelist(): array
    {
        return [

        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}