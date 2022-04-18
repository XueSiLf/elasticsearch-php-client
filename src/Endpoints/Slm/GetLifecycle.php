<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/18 19:02:34
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Slm;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetLifecycle
 * Elasticsearch API name slm.get_lifecycle
 */
class GetLifecycle extends AbstractEndpoint
{
    protected $policy_id;

    public function getURI(): string
    {
        $policy_id = $this->policy_id ?? null;

        if (isset($policy_id)) {
            return "/_slm/policy/$policy_id";
        }
        return "/_slm/policy";
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setPolicyId($policy_id): GetLifecycle
    {
        if (isset($policy_id) !== true) {
            return $this;
        }
        if (is_array($policy_id) === true) {
            $policy_id = implode(",", $policy_id);
        }
        $this->policy_id = $policy_id;

        return $this;
    }
}