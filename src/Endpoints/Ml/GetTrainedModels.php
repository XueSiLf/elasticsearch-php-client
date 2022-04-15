<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:40:03
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetTrainedModels
 * Elasticsearch API name ml.get_trained_models
 */
class GetTrainedModels extends AbstractEndpoint
{
    protected $model_id;

    public function getURI(): string
    {
        $model_id = $this->model_id ?? null;

        if (isset($model_id)) {
            return "/_ml/trained_models/$model_id";
        }
        return "/_ml/trained_models";
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_no_match',
            'include',
            'include_model_definition',
            'decompress_definition',
            'from',
            'size',
            'tags',
            'exclude_generated'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function setModelId($model_id): GetTrainedModels
    {
        if (isset($model_id) !== true) {
            return $this;
        }
        $this->model_id = $model_id;

        return $this;
    }
}
