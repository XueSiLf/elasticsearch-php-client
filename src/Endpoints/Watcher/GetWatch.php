<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:23:41
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Watcher;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetWatch
 * Elasticsearch API name watcher.get_watch
 */
class GetWatch extends AbstractEndpoint
{
    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_watcher/watch/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint watcher.get_watch');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}
