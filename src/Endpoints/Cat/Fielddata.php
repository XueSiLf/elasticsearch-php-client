<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 19:28:28
 */
declare(strict_types=1);

namespace LavaMusic\Elasticsearch\Endpoints\Cat;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class Fielddata
 * Elasticsearch API name cat.fielddata
 */
class Fielddata extends AbstractEndpoint
{
    protected $fields;

    public function getURI(): string
    {
        $fields = $this->fields ?? null;

        if (isset($fields)) {
            return "/_cat/fielddata/$fields";
        }
        return "/_cat/fielddata";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'bytes',
            'h',
            'help',
            's',
            'v',
            'fields'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setFields($fields): Fielddata
    {
        if (isset($fields) !== true) {
            return $this;
        }
        if (is_array($fields) === true) {
            $fields = implode(",", $fields);
        }
        $this->fields = $fields;

        return $this;
    }
}
