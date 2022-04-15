<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 12:15:43
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints\Ml;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;
use LavaMusic\ElasticSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteTrainedModelAlias
 * Elasticsearch API name ml.delete_trained_model_alias
 */
class DeleteTrainedModelAlias extends AbstractEndpoint
{
    protected $model_alias;
    protected $model_id;

    public function getURI(): string
    {
        $model_alias = $this->model_alias ?? null;
        $model_id = $this->model_id ?? null;

        if (isset($model_id) && isset($model_alias)) {
            return "/_ml/trained_models/$model_id/model_aliases/$model_alias";
        }
        throw new RuntimeException('Missing parameter for the endpoint ml.delete_trained_model_alias');
    }

    public function getParamWhitelist(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setModelAlias($model_alias): DeleteTrainedModelAlias
    {
        if (isset($model_alias) !== true) {
            return $this;
        }
        $this->model_alias = $model_alias;

        return $this;
    }

    public function setModelId($model_id): DeleteTrainedModelAlias
    {
        if (isset($model_id) !== true) {
            return $this;
        }
        $this->model_id = $model_id;

        return $this;
    }
}
