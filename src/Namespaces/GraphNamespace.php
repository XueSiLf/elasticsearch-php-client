<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/14 20:45:55
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\Elasticsearch\Endpoints\Graph;

/**
 * Class GraphNamespace
 */
class GraphNamespace extends AbstractNamespace
{
    /**
     * Explore extracted and summarized information about the documents and terms in an index.
     *
     * $params['index']   = (list) A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices (Required)
     * $params['type']    = DEPRECATED (list) A comma-separated list of document types to search; leave empty to perform the operation on all types
     * $params['routing'] = (string) Specific routing value
     * $params['timeout'] = (time) Explicit operation timeout
     * $params['body']    = (array) Graph Query DSL
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/graph-explore-api.html
     */
    public function explore(array $params = [])
    {
        $index = $this->extractArgument($params, 'index');
        $type = $this->extractArgument($params, 'type');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Graph\Explore $endpoint */
        $endpoint = $endpointBuilder('Graph\Explore');
        $endpoint->setParams($params);
        $endpoint->setIndex($index);
        $endpoint->setType($type);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}
