<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:40:52
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class ThreadPool
 * Elasticsearch API name cat.thread_pool
 */
class ThreadPool extends AbstractEndpoint
{
    protected $thread_pool_patterns;

    public function getURI(): string
    {
        $thread_pool_patterns = $this->thread_pool_patterns ?? null;

        if (isset($thread_pool_patterns)) {
            return "/_cat/thread_pool/$thread_pool_patterns";
        }
        return "/_cat/thread_pool";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'size',
            'local',
            'master_timeout',
            'h',
            'help',
            's',
            'v'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setThreadPoolPatterns($thread_pool_patterns): ThreadPool
    {
        if (isset($thread_pool_patterns) !== true) {
            return $this;
        }
        if (is_array($thread_pool_patterns) === true) {
            $thread_pool_patterns = implode(",", $thread_pool_patterns);
        }
        $this->thread_pool_patterns = $thread_pool_patterns;

        return $this;
    }
}