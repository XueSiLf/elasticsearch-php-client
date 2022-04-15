<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 11:21:41
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\TextStructure;

/**
 * Class TextStructureNamespace
 */
class TextStructureNamespace extends AbstractNamespace
{
    /**
     * Finds the structure of a text file. The text file must contain data that is suitable to be ingested into Elasticsearch.
     *
     * $params['lines_to_sample']       = (int) How many lines of the file should be included in the analysis (Default = 1000)
     * $params['line_merge_size_limit'] = (int) Maximum number of characters permitted in a single message when lines are merged to create messages. (Default = 10000)
     * $params['timeout']               = (time) Timeout after which the analysis will be aborted (Default = 25s)
     * $params['charset']               = (string) Optional parameter to specify the character set of the file
     * $params['format']                = (enum) Optional parameter to specify the high level file format (Options = ndjson,xml,delimited,semi_structured_text)
     * $params['has_header_row']        = (boolean) Optional parameter to specify whether a delimited file includes the column names in its first row
     * $params['column_names']          = (list) Optional parameter containing a comma separated list of the column names for a delimited file
     * $params['delimiter']             = (string) Optional parameter to specify the delimiter character for a delimited file - must be a single character
     * $params['quote']                 = (string) Optional parameter to specify the quote character for a delimited file - must be a single character
     * $params['should_trim_fields']    = (boolean) Optional parameter to specify whether the values between delimiters in a delimited file should have whitespace trimmed from them
     * $params['grok_pattern']          = (string) Optional parameter to specify the Grok pattern that should be used to extract fields from messages in a semi-structured text file
     * $params['timestamp_field']       = (string) Optional parameter to specify the timestamp field in the file
     * $params['timestamp_format']      = (string) Optional parameter to specify the timestamp format in the file - may be either a Joda or Java time format
     * $params['explain']               = (boolean) Whether to include a commentary on how the structure was derived (Default = false)
     * $params['body']                  = (array) The contents of the file to be analyzed (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/find-structure.html
     */
    public function findStructure(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var TextStructure\FindStructure $endpoint */
        $endpoint = $endpointBuilder('TextStructure\FindStructure');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}