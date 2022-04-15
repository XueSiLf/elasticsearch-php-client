<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:09:46
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Endpoints;

use LavaMusic\ElasticSearch\Common\Exceptions\RuntimeException;

/**
 * Class SearchMvt
 * Elasticsearch API name search_mvt
 */
class SearchMvt extends AbstractEndpoint
{
    protected $field;
    protected $zoom;
    protected $x;
    protected $y;

    public function getURI(): string
    {
        $index = $this->index ?? null;
        $field = $this->field ?? null;
        $zoom = $this->zoom ?? null;
        $x = $this->x ?? null;
        $y = $this->y ?? null;

        if (isset($index) && isset($field) && isset($zoom) && isset($x) && isset($y)) {
            return "/$index/_mvt/$field/$zoom/$x/$y";
        }
        throw new RuntimeException('Missing parameter for the endpoint search_mvt');
    }

    public function getParamWhitelist(): array
    {
        return [
            'exact_bounds',
            'extent',
            'grid_precision',
            'grid_type',
            'size',
            'track_total_hits'
        ];
    }

    public function getMethod(): string
    {
        return isset($this->body) ? 'POST' : 'GET';
    }

    public function setBody($body): SearchMvt
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setField($field): SearchMvt
    {
        if (isset($field) !== true) {
            return $this;
        }
        $this->field = $field;

        return $this;
    }

    public function setZoom($zoom): SearchMvt
    {
        if (isset($zoom) !== true) {
            return $this;
        }
        $this->zoom = $zoom;

        return $this;
    }

    public function setX($x): SearchMvt
    {
        if (isset($x) !== true) {
            return $this;
        }
        $this->x = $x;

        return $this;
    }

    public function setY($y): SearchMvt
    {
        if (isset($y) !== true) {
            return $this;
        }
        $this->y = $y;

        return $this;
    }
}