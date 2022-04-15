<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 15:33:38
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Ml;

/**
 * Class MlNamespace
 */
class MlNamespace extends AbstractNamespace
{
    /**
     * Closes one or more anomaly detection jobs. A job can be opened and closed multiple times throughout its lifecycle.
     *
     * $params['job_id']         = (string) The name of the job to close
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['allow_no_jobs']  = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['force']          = (boolean) True if the job should be forcefully closed
     * $params['timeout']        = (time) Controls the time to wait until a job has closed. Default to 30 minutes
     * $params['body']           = (array) The URL params optionally sent in the body
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-close-job.html
     */
    public function closeJob(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\CloseJob $endpoint */
        $endpoint = $endpointBuilder('Ml\CloseJob');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes a calendar.
     *
     * $params['calendar_id'] = (string) The ID of the calendar to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-calendar.html
     */
    public function deleteCalendar(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteCalendar $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteCalendar');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes scheduled events from a calendar.
     *
     * $params['calendar_id'] = (string) The ID of the calendar to modify
     * $params['event_id']    = (string) The ID of the event to remove from the calendar
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-calendar-event.html
     */
    public function deleteCalendarEvent(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');
        $event_id = $this->extractArgument($params, 'event_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteCalendarEvent $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteCalendarEvent');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);
        $endpoint->setEventId($event_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes anomaly detection jobs from a calendar.
     *
     * $params['calendar_id'] = (string) The ID of the calendar to modify
     * $params['job_id']      = (string) The ID of the job to remove from the calendar
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-calendar-job.html
     */
    public function deleteCalendarJob(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');
        $job_id = $this->extractArgument($params, 'job_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteCalendarJob $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteCalendarJob');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);
        $endpoint->setJobId($job_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes an existing data frame analytics job.
     *
     * $params['id']      = (string) The ID of the data frame analytics to delete
     * $params['force']   = (boolean) True if the job should be forcefully deleted (Default = false)
     * $params['timeout'] = (time) Controls the time to wait until a job is deleted. Defaults to 1 minute
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/delete-dfanalytics.html
     */
    public function deleteDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes an existing datafeed.
     *
     * $params['datafeed_id'] = (string) The ID of the datafeed to delete
     * $params['force']       = (boolean) True if the datafeed should be forcefully deleted
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-datafeed.html
     */
    public function deleteDatafeed(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteDatafeed $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteDatafeed');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes expired and unused machine learning data.
     *
     * $params['job_id']              = (string) The ID of the job(s) to perform expired data hygiene for
     * $params['requests_per_second'] = (number) The desired requests per second for the deletion processes.
     * $params['timeout']             = (time) How long can the underlying delete processes run until they are canceled
     * $params['body']                = (array) deleting expired data parameters
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-expired-data.html
     */
    public function deleteExpiredData(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteExpiredData $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteExpiredData');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes a filter.
     *
     * $params['filter_id'] = (string) The ID of the filter to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-filter.html
     */
    public function deleteFilter(array $params = [])
    {
        $filter_id = $this->extractArgument($params, 'filter_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteFilter $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteFilter');
        $endpoint->setParams($params);
        $endpoint->setFilterId($filter_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes forecasts from a machine learning job.
     *
     * $params['job_id']             = (string) The ID of the job from which to delete forecasts (Required)
     * $params['forecast_id']        = (string) The ID of the forecast to delete, can be comma delimited list. Leaving blank implies `_all`
     * $params['allow_no_forecasts'] = (boolean) Whether to ignore if `_all` matches no forecasts
     * $params['timeout']            = (time) Controls the time to wait until the forecast(s) are deleted. Default to 30 seconds
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-forecast.html
     */
    public function deleteForecast(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $forecast_id = $this->extractArgument($params, 'forecast_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteForecast $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteForecast');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setForecastId($forecast_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes an existing anomaly detection job.
     *
     * $params['job_id']              = (string) The ID of the job to delete
     * $params['force']               = (boolean) True if the job should be forcefully deleted (Default = false)
     * $params['wait_for_completion'] = (boolean) Should this request wait until the operation has completed before returning (Default = true)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-job.html
     */
    public function deleteJob(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteJob $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteJob');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes an existing model snapshot.
     *
     * $params['job_id']      = (string) The ID of the job to fetch
     * $params['snapshot_id'] = (string) The ID of the snapshot to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-delete-snapshot.html
     */
    public function deleteModelSnapshot(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $snapshot_id = $this->extractArgument($params, 'snapshot_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteModelSnapshot $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteModelSnapshot');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setSnapshotId($snapshot_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes an existing trained inference model that is currently not referenced by an ingest pipeline.
     *
     * $params['model_id'] = (string) The ID of the trained model to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/delete-trained-models.html
     */
    public function deleteTrainedModel(array $params = [])
    {
        $model_id = $this->extractArgument($params, 'model_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteTrainedModel $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteTrainedModel');
        $endpoint->setParams($params);
        $endpoint->setModelId($model_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes a model alias that refers to the trained model
     *
     * $params['model_alias'] = (string) The trained model alias to delete
     * $params['model_id']    = (string) The trained model where the model alias is assigned
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/delete-trained-models-aliases.html
     */
    public function deleteTrainedModelAlias(array $params = [])
    {
        $model_alias = $this->extractArgument($params, 'model_alias');
        $model_id = $this->extractArgument($params, 'model_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\DeleteTrainedModelAlias $endpoint */
        $endpoint = $endpointBuilder('Ml\DeleteTrainedModelAlias');
        $endpoint->setParams($params);
        $endpoint->setModelAlias($model_alias);
        $endpoint->setModelId($model_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Estimates the model memory
     *
     * $params['body'] = (array) The analysis config, plus cardinality estimates for fields it references (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-apis.html
     */
    public function estimateModelMemory(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\EstimateModelMemory $endpoint */
        $endpoint = $endpointBuilder('Ml\EstimateModelMemory');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Evaluates the data frame analytics for an annotated index.
     *
     * $params['body'] = (array) The evaluation definition (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/evaluate-dfanalytics.html
     */
    public function evaluateDataFrame(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\EvaluateDataFrame $endpoint */
        $endpoint = $endpointBuilder('Ml\EvaluateDataFrame');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Explains a data frame analytics config.
     *
     * $params['id']   = (string) The ID of the data frame analytics to explain
     * $params['body'] = (array) The data frame analytics config to explain
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see http://www.elastic.co/guide/en/elasticsearch/reference/current/explain-dfanalytics.html
     */
    public function explainDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\ExplainDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\ExplainDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

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
     *
     * @note This API is EXPERIMENTAL and may be changed or removed completely in a future release
     *
     */
    public function findFileStructure(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\FindFileStructure $endpoint */
        $endpoint = $endpointBuilder('Ml\FindFileStructure');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Forces any buffered data to be processed by the job.
     *
     * $params['job_id']       = (string) The name of the job to flush
     * $params['calc_interim'] = (boolean) Calculates interim results for the most recent bucket or all buckets within the latency period
     * $params['start']        = (string) When used in conjunction with calc_interim, specifies the range of buckets on which to calculate interim results
     * $params['end']          = (string) When used in conjunction with calc_interim, specifies the range of buckets on which to calculate interim results
     * $params['advance_time'] = (string) Advances time to the given value generating results and updating the model for the advanced interval
     * $params['skip_time']    = (string) Skips time to the given value without generating results or updating the model for the skipped interval
     * $params['body']         = (array) Flush parameters
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-flush-job.html
     */
    public function flushJob(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\FlushJob $endpoint */
        $endpoint = $endpointBuilder('Ml\FlushJob');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Predicts the future behavior of a time series by using its historical behavior.
     *
     * $params['job_id']           = (string) The ID of the job to forecast for
     * $params['duration']         = (time) The duration of the forecast
     * $params['expires_in']       = (time) The time interval after which the forecast expires. Expired forecasts will be deleted at the first opportunity.
     * $params['max_model_memory'] = (string) The max memory able to be used by the forecast. Default is 20mb.
     * $params['body']             = (array) Query parameters can be specified in the body
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-forecast.html
     */
    public function forecast(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\Forecast $endpoint */
        $endpoint = $endpointBuilder('Ml\Forecast');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves anomaly detection job results for one or more buckets.
     *
     * $params['job_id']          = (string) ID of the job to get bucket results from (Required)
     * $params['timestamp']       = (string) The timestamp of the desired single bucket result
     * $params['expand']          = (boolean) Include anomaly records
     * $params['exclude_interim'] = (boolean) Exclude interim results
     * $params['from']            = (int) skips a number of buckets
     * $params['size']            = (int) specifies a max number of buckets to get
     * $params['start']           = (string) Start time filter for buckets
     * $params['end']             = (string) End time filter for buckets
     * $params['anomaly_score']   = (double) Filter for the most anomalous buckets
     * $params['sort']            = (string) Sort buckets by a particular field
     * $params['desc']            = (boolean) Set the sort direction
     * $params['body']            = (array) Bucket selection details if not provided in URI
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-bucket.html
     */
    public function getBuckets(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $timestamp = $this->extractArgument($params, 'timestamp');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetBuckets $endpoint */
        $endpoint = $endpointBuilder('Ml\GetBuckets');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setTimestamp($timestamp);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information about the scheduled events in calendars.
     *
     * $params['calendar_id'] = (string) The ID of the calendar containing the events
     * $params['job_id']      = (string) Get events for the job. When this option is used calendar_id must be '_all'
     * $params['start']       = (string) Get events after this time
     * $params['end']         = (date) Get events before this time
     * $params['from']        = (int) Skips a number of events
     * $params['size']        = (int) Specifies a max number of events to get
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-calendar-event.html
     */
    public function getCalendarEvents(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetCalendarEvents $endpoint */
        $endpoint = $endpointBuilder('Ml\GetCalendarEvents');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves configuration information for calendars.
     *
     * $params['calendar_id'] = (string) The ID of the calendar to fetch
     * $params['from']        = (int) skips a number of calendars
     * $params['size']        = (int) specifies a max number of calendars to get
     * $params['body']        = (array) The from and size parameters optionally sent in the body
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-calendar.html
     */
    public function getCalendars(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetCalendars $endpoint */
        $endpoint = $endpointBuilder('Ml\GetCalendars');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves anomaly detection job results for one or more categories.
     *
     * $params['job_id']                = (string) The name of the job (Required)
     * $params['category_id']           = (long) The identifier of the category definition of interest
     * $params['from']                  = (int) skips a number of categories
     * $params['size']                  = (int) specifies a max number of categories to get
     * $params['partition_field_value'] = (string) Specifies the partition to retrieve categories for. This is optional, and should never be used for jobs where per-partition categorization is disabled.
     * $params['body']                  = (array) Category selection details if not provided in URI
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-category.html
     */
    public function getCategories(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $category_id = $this->extractArgument($params, 'category_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetCategories $endpoint */
        $endpoint = $endpointBuilder('Ml\GetCategories');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setCategoryId($category_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves configuration information for data frame analytics jobs.
     *
     * $params['id']                = (string) The ID of the data frame analytics to fetch
     * $params['allow_no_match']    = (boolean) Whether to ignore if a wildcard expression matches no data frame analytics. (This includes `_all` string or when no data frame analytics have been specified) (Default = true)
     * $params['from']              = (int) skips a number of analytics (Default = 0)
     * $params['size']              = (int) specifies a max number of analytics to get (Default = 100)
     * $params['exclude_generated'] = (boolean) Omits fields that are illegal to set on data frame analytics PUT (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-dfanalytics.html
     */
    public function getDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\GetDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves usage information for data frame analytics jobs.
     *
     * $params['id']             = (string) The ID of the data frame analytics stats to fetch
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no data frame analytics. (This includes `_all` string or when no data frame analytics have been specified) (Default = true)
     * $params['from']           = (int) skips a number of analytics (Default = 0)
     * $params['size']           = (int) specifies a max number of analytics to get (Default = 100)
     * $params['verbose']        = (boolean) whether the stats response should be verbose (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-dfanalytics-stats.html
     */
    public function getDataFrameAnalyticsStats(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetDataFrameAnalyticsStats $endpoint */
        $endpoint = $endpointBuilder('Ml\GetDataFrameAnalyticsStats');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves usage information for datafeeds.
     *
     * $params['datafeed_id']        = (string) The ID of the datafeeds stats to fetch
     * $params['allow_no_match']     = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     * $params['allow_no_datafeeds'] = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-datafeed-stats.html
     */
    public function getDatafeedStats(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetDatafeedStats $endpoint */
        $endpoint = $endpointBuilder('Ml\GetDatafeedStats');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves configuration information for datafeeds.
     *
     * $params['datafeed_id']        = (string) The ID of the datafeeds to fetch
     * $params['allow_no_match']     = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     * $params['allow_no_datafeeds'] = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     * $params['exclude_generated']  = (boolean) Omits fields that are illegal to set on datafeed PUT (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-datafeed.html
     */
    public function getDatafeeds(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetDatafeeds $endpoint */
        $endpoint = $endpointBuilder('Ml\GetDatafeeds');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves filters.
     *
     * $params['filter_id'] = (string) The ID of the filter to fetch
     * $params['from']      = (int) skips a number of filters
     * $params['size']      = (int) specifies a max number of filters to get
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-filter.html
     */
    public function getFilters(array $params = [])
    {
        $filter_id = $this->extractArgument($params, 'filter_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetFilters $endpoint */
        $endpoint = $endpointBuilder('Ml\GetFilters');
        $endpoint->setParams($params);
        $endpoint->setFilterId($filter_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves anomaly detection job results for one or more influencers.
     *
     * $params['job_id']           = (string) Identifier for the anomaly detection job
     * $params['exclude_interim']  = (boolean) Exclude interim results
     * $params['from']             = (int) skips a number of influencers
     * $params['size']             = (int) specifies a max number of influencers to get
     * $params['start']            = (string) start timestamp for the requested influencers
     * $params['end']              = (string) end timestamp for the requested influencers
     * $params['influencer_score'] = (double) influencer score threshold for the requested influencers
     * $params['sort']             = (string) sort field for the requested influencers
     * $params['desc']             = (boolean) whether the results should be sorted in decending order
     * $params['body']             = (array) Influencer selection criteria
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-influencer.html
     */
    public function getInfluencers(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetInfluencers $endpoint */
        $endpoint = $endpointBuilder('Ml\GetInfluencers');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves usage information for anomaly detection jobs.
     *
     * $params['job_id']         = (string) The ID of the jobs stats to fetch
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['allow_no_jobs']  = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-job-stats.html
     */
    public function getJobStats(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetJobStats $endpoint */
        $endpoint = $endpointBuilder('Ml\GetJobStats');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves configuration information for anomaly detection jobs.
     *
     * $params['job_id']            = (string) The ID of the jobs to fetch
     * $params['allow_no_match']    = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['allow_no_jobs']     = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['exclude_generated'] = (boolean) Omits fields that are illegal to set on job PUT (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-job.html
     */
    public function getJobs(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetJobs $endpoint */
        $endpoint = $endpointBuilder('Ml\GetJobs');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Gets stats for anomaly detection job model snapshot upgrades that are in progress.
     *
     * $params['job_id']         = (string) The ID of the job. May be a wildcard, comma separated list or `_all`.
     * $params['snapshot_id']    = (string) The ID of the snapshot. May be a wildcard, comma separated list or `_all`.
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no jobs or no snapshots. (This includes the `_all` string.)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-job-model-snapshot-upgrade-stats.html
     */
    public function getModelSnapshotUpgradeStats(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $snapshot_id = $this->extractArgument($params, 'snapshot_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetModelSnapshotUpgradeStats $endpoint */
        $endpoint = $endpointBuilder('Ml\GetModelSnapshotUpgradeStats');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setSnapshotId($snapshot_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information about model snapshots.
     *
     * $params['job_id']      = (string) The ID of the job to fetch (Required)
     * $params['snapshot_id'] = (string) The ID of the snapshot to fetch
     * $params['from']        = (int) Skips a number of documents
     * $params['size']        = (int) The default number of documents returned in queries as a string.
     * $params['start']       = (date) The filter 'start' query parameter
     * $params['end']         = (date) The filter 'end' query parameter
     * $params['sort']        = (string) Name of the field to sort on
     * $params['desc']        = (boolean) True if the results should be sorted in descending order
     * $params['body']        = (array) Model snapshot selection criteria
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-snapshot.html
     */
    public function getModelSnapshots(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $snapshot_id = $this->extractArgument($params, 'snapshot_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetModelSnapshots $endpoint */
        $endpoint = $endpointBuilder('Ml\GetModelSnapshots');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setSnapshotId($snapshot_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves overall bucket results that summarize the bucket results of multiple anomaly detection jobs.
     *
     * $params['job_id']          = (string) The job IDs for which to calculate overall bucket results
     * $params['top_n']           = (int) The number of top job bucket scores to be used in the overall_score calculation
     * $params['bucket_span']     = (string) The span of the overall buckets. Defaults to the longest job bucket_span
     * $params['overall_score']   = (double) Returns overall buckets with overall scores higher than this value
     * $params['exclude_interim'] = (boolean) If true overall buckets that include interim buckets will be excluded
     * $params['start']           = (string) Returns overall buckets with timestamps after this time
     * $params['end']             = (string) Returns overall buckets with timestamps earlier than this time
     * $params['allow_no_match']  = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['allow_no_jobs']   = (boolean) Whether to ignore if a wildcard expression matches no jobs. (This includes `_all` string or when no jobs have been specified)
     * $params['body']            = (array) Overall bucket selection details if not provided in URI
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-overall-buckets.html
     */
    public function getOverallBuckets(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetOverallBuckets $endpoint */
        $endpoint = $endpointBuilder('Ml\GetOverallBuckets');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves anomaly records for an anomaly detection job.
     *
     * $params['job_id']          = (string) The ID of the job
     * $params['exclude_interim'] = (boolean) Exclude interim results
     * $params['from']            = (int) skips a number of records
     * $params['size']            = (int) specifies a max number of records to get
     * $params['start']           = (string) Start time filter for records
     * $params['end']             = (string) End time filter for records
     * $params['record_score']    = (double) Returns records with anomaly scores greater or equal than this value
     * $params['sort']            = (string) Sort records by a particular field
     * $params['desc']            = (boolean) Set the sort direction
     * $params['body']            = (array) Record selection criteria
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-get-record.html
     */
    public function getRecords(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetRecords $endpoint */
        $endpoint = $endpointBuilder('Ml\GetRecords');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves configuration information for a trained inference model.
     *
     * $params['model_id']                 = (string) The ID of the trained models to fetch
     * $params['allow_no_match']           = (boolean) Whether to ignore if a wildcard expression matches no trained models. (This includes `_all` string or when no trained models have been specified) (Default = true)
     * $params['include']                  = (string) A comma-separate list of fields to optionally include. Valid options are 'definition' and 'total_feature_importance'. Default is none.
     * $params['include_model_definition'] = (boolean) Should the full model definition be included in the results. These definitions can be large. So be cautious when including them. Defaults to false. (Default = false)
     * $params['decompress_definition']    = (boolean) Should the model definition be decompressed into valid JSON or returned in a custom compressed format. Defaults to true. (Default = true)
     * $params['from']                     = (int) skips a number of trained models (Default = 0)
     * $params['size']                     = (int) specifies a max number of trained models to get (Default = 100)
     * $params['tags']                     = (list) A comma-separated list of tags that the model must have.
     * $params['exclude_generated']        = (boolean) Omits fields that are illegal to set on model PUT (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-trained-models.html
     */
    public function getTrainedModels(array $params = [])
    {
        $model_id = $this->extractArgument($params, 'model_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetTrainedModels $endpoint */
        $endpoint = $endpointBuilder('Ml\GetTrainedModels');
        $endpoint->setParams($params);
        $endpoint->setModelId($model_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves usage information for trained inference models.
     *
     * $params['model_id']       = (string) The ID of the trained models stats to fetch
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no trained models. (This includes `_all` string or when no trained models have been specified) (Default = true)
     * $params['from']           = (int) skips a number of trained models (Default = 0)
     * $params['size']           = (int) specifies a max number of trained models to get (Default = 100)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-trained-models-stats.html
     */
    public function getTrainedModelsStats(array $params = [])
    {
        $model_id = $this->extractArgument($params, 'model_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\GetTrainedModelsStats $endpoint */
        $endpoint = $endpointBuilder('Ml\GetTrainedModelsStats');
        $endpoint->setParams($params);
        $endpoint->setModelId($model_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns defaults and limits used by machine learning.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/get-ml-info.html
     */
    public function info(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ml\Info $endpoint */
        $endpoint = $endpointBuilder('Ml\Info');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Opens one or more anomaly detection jobs.
     *
     * $params['job_id'] = (string) The ID of the job to open
     * $params['body']   = (array) Query parameters can be specified in the body
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-open-job.html
     */
    public function openJob(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\OpenJob $endpoint */
        $endpoint = $endpointBuilder('Ml\OpenJob');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Posts scheduled events in a calendar.
     *
     * $params['calendar_id'] = (string) The ID of the calendar to modify
     * $params['body']        = (array) A list of events (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-post-calendar-event.html
     */
    public function postCalendarEvents(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PostCalendarEvents $endpoint */
        $endpoint = $endpointBuilder('Ml\PostCalendarEvents');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Sends data to an anomaly detection job for analysis.
     *
     * $params['job_id']      = (string) The name of the job receiving the data
     * $params['reset_start'] = (string) Optional parameter to specify the start of the bucket resetting range
     * $params['reset_end']   = (string) Optional parameter to specify the end of the bucket resetting range
     * $params['body']        = (array) The data to process (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-post-data.html
     */
    public function postData(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PostData $endpoint */
        $endpoint = $endpointBuilder('Ml\PostData');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Previews that will be analyzed given a data frame analytics config.
     *
     * $params['id']   = (string) The ID of the data frame analytics to preview
     * $params['body'] = (array) The data frame analytics config to preview
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see http://www.elastic.co/guide/en/elasticsearch/reference/current/preview-dfanalytics.html
     */
    public function previewDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PreviewDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\PreviewDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Previews a datafeed.
     *
     * $params['datafeed_id'] = (string) The ID of the datafeed to preview
     * $params['body']        = (array) The datafeed config and job config with which to execute the preview
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-preview-datafeed.html
     */
    public function previewDatafeed(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PreviewDatafeed $endpoint */
        $endpoint = $endpointBuilder('Ml\PreviewDatafeed');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Instantiates a calendar.
     *
     * $params['calendar_id'] = (string) The ID of the calendar to create
     * $params['body']        = (array) The calendar details
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-put-calendar.html
     */
    public function putCalendar(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutCalendar $endpoint */
        $endpoint = $endpointBuilder('Ml\PutCalendar');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Adds an anomaly detection job to a calendar.
     *
     * $params['calendar_id'] = (string) The ID of the calendar to modify
     * $params['job_id']      = (string) The ID of the job to add to the calendar
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-put-calendar-job.html
     */
    public function putCalendarJob(array $params = [])
    {
        $calendar_id = $this->extractArgument($params, 'calendar_id');
        $job_id = $this->extractArgument($params, 'job_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutCalendarJob $endpoint */
        $endpoint = $endpointBuilder('Ml\PutCalendarJob');
        $endpoint->setParams($params);
        $endpoint->setCalendarId($calendar_id);
        $endpoint->setJobId($job_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Instantiates a data frame analytics job.
     *
     * $params['id']   = (string) The ID of the data frame analytics to create
     * $params['body'] = (array) The data frame analytics configuration (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/put-dfanalytics.html
     */
    public function putDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\PutDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Instantiates a datafeed.
     *
     * $params['datafeed_id']        = (string) The ID of the datafeed to create
     * $params['ignore_unavailable'] = (boolean) Ignore unavailable indexes (default: false)
     * $params['allow_no_indices']   = (boolean) Ignore if the source indices expressions resolves to no concrete indices (default: true)
     * $params['ignore_throttled']   = (boolean) Ignore indices that are marked as throttled (default: true)
     * $params['expand_wildcards']   = (enum) Whether source index expressions should get expanded to open or closed indices (default: open) (Options = open,closed,hidden,none,all)
     * $params['body']               = (array) The datafeed config (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-put-datafeed.html
     */
    public function putDatafeed(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutDatafeed $endpoint */
        $endpoint = $endpointBuilder('Ml\PutDatafeed');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Instantiates a filter.
     *
     * $params['filter_id'] = (string) The ID of the filter to create
     * $params['body']      = (array) The filter details (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-put-filter.html
     */
    public function putFilter(array $params = [])
    {
        $filter_id = $this->extractArgument($params, 'filter_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutFilter $endpoint */
        $endpoint = $endpointBuilder('Ml\PutFilter');
        $endpoint->setParams($params);
        $endpoint->setFilterId($filter_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Instantiates an anomaly detection job.
     *
     * $params['job_id']             = (string) The ID of the job to create
     * $params['ignore_unavailable'] = (boolean) Ignore unavailable indexes (default: false). Only set if datafeed_config is provided.
     * $params['allow_no_indices']   = (boolean) Ignore if the source indices expressions resolves to no concrete indices (default: true). Only set if datafeed_config is provided.
     * $params['ignore_throttled']   = (boolean) Ignore indices that are marked as throttled (default: true). Only set if datafeed_config is provided.
     * $params['expand_wildcards']   = (enum) Whether source index expressions should get expanded to open or closed indices (default: open). Only set if datafeed_config is provided. (Options = open,closed,hidden,none,all)
     * $params['body']               = (array) The job (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-put-job.html
     */
    public function putJob(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutJob $endpoint */
        $endpoint = $endpointBuilder('Ml\PutJob');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates an inference trained model.
     *
     * $params['model_id']                       = (string) The ID of the trained models to store
     * $params['defer_definition_decompression'] = (boolean) If set to `true` and a `compressed_definition` is provided, the request defers definition decompression and skips relevant validations. (Default = false)
     * $params['body']                           = (array) The trained model configuration (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/put-trained-models.html
     */
    public function putTrainedModel(array $params = [])
    {
        $model_id = $this->extractArgument($params, 'model_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutTrainedModel $endpoint */
        $endpoint = $endpointBuilder('Ml\PutTrainedModel');
        $endpoint->setParams($params);
        $endpoint->setModelId($model_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a new model alias (or reassigns an existing one) to refer to the trained model
     *
     * $params['model_alias'] = (string) The trained model alias to update
     * $params['model_id']    = (string) The trained model where the model alias should be assigned
     * $params['reassign']    = (boolean) If the model_alias already exists and points to a separate model_id, this parameter must be true. Defaults to false.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/put-trained-models-aliases.html
     */
    public function putTrainedModelAlias(array $params = [])
    {
        $model_alias = $this->extractArgument($params, 'model_alias');
        $model_id = $this->extractArgument($params, 'model_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\PutTrainedModelAlias $endpoint */
        $endpoint = $endpointBuilder('Ml\PutTrainedModelAlias');
        $endpoint->setParams($params);
        $endpoint->setModelAlias($model_alias);
        $endpoint->setModelId($model_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Resets an existing anomaly detection job.
     *
     * $params['job_id']              = (string) The ID of the job to reset
     * $params['wait_for_completion'] = (boolean) Should this request wait until the operation has completed before returning (Default = true)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-reset-job.html
     */
    public function resetJob(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\ResetJob $endpoint */
        $endpoint = $endpointBuilder('Ml\ResetJob');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Reverts to a specific snapshot.
     *
     * $params['job_id']                     = (string) The ID of the job to fetch
     * $params['snapshot_id']                = (string) The ID of the snapshot to revert to
     * $params['delete_intervening_results'] = (boolean) Should we reset the results back to the time of the snapshot?
     * $params['body']                       = (array) Reversion options
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-revert-snapshot.html
     */
    public function revertModelSnapshot(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $snapshot_id = $this->extractArgument($params, 'snapshot_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\RevertModelSnapshot $endpoint */
        $endpoint = $endpointBuilder('Ml\RevertModelSnapshot');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setSnapshotId($snapshot_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Sets a cluster wide upgrade_mode setting that prepares machine learning indices for an upgrade.
     *
     * $params['enabled'] = (boolean) Whether to enable upgrade_mode ML setting or not. Defaults to false.
     * $params['timeout'] = (time) Controls the time to wait before action times out. Defaults to 30 seconds
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-set-upgrade-mode.html
     */
    public function setUpgradeMode(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Ml\SetUpgradeMode $endpoint */
        $endpoint = $endpointBuilder('Ml\SetUpgradeMode');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Starts a data frame analytics job.
     *
     * $params['id']      = (string) The ID of the data frame analytics to start
     * $params['timeout'] = (time) Controls the time to wait until the task has started. Defaults to 20 seconds
     * $params['body']    = (array) The start data frame analytics parameters
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/start-dfanalytics.html
     */
    public function startDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\StartDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\StartDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Starts one or more datafeeds.
     *
     * $params['datafeed_id'] = (string) The ID of the datafeed to start
     * $params['start']       = (string) The start time from where the datafeed should begin
     * $params['end']         = (string) The end time when the datafeed should stop. When not set, the datafeed continues in real time
     * $params['timeout']     = (time) Controls the time to wait until a datafeed has started. Default to 20 seconds
     * $params['body']        = (array) The start datafeed parameters
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-start-datafeed.html
     */
    public function startDatafeed(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\StartDatafeed $endpoint */
        $endpoint = $endpointBuilder('Ml\StartDatafeed');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Stops one or more data frame analytics jobs.
     *
     * $params['id']             = (string) The ID of the data frame analytics to stop
     * $params['allow_no_match'] = (boolean) Whether to ignore if a wildcard expression matches no data frame analytics. (This includes `_all` string or when no data frame analytics have been specified)
     * $params['force']          = (boolean) True if the data frame analytics should be forcefully stopped
     * $params['timeout']        = (time) Controls the time to wait until the task has stopped. Defaults to 20 seconds
     * $params['body']           = (array) The stop data frame analytics parameters
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/stop-dfanalytics.html
     */
    public function stopDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\StopDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\StopDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Stops one or more datafeeds.
     *
     * $params['datafeed_id']        = (string) The ID of the datafeed to stop
     * $params['allow_no_match']     = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     * $params['allow_no_datafeeds'] = (boolean) Whether to ignore if a wildcard expression matches no datafeeds. (This includes `_all` string or when no datafeeds have been specified)
     * $params['force']              = (boolean) True if the datafeed should be forcefully stopped.
     * $params['timeout']            = (time) Controls the time to wait until a datafeed has stopped. Default to 20 seconds
     * $params['body']               = (array) The URL params optionally sent in the body
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-stop-datafeed.html
     */
    public function stopDatafeed(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\StopDatafeed $endpoint */
        $endpoint = $endpointBuilder('Ml\StopDatafeed');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates certain properties of a data frame analytics job.
     *
     * $params['id']   = (string) The ID of the data frame analytics to update
     * $params['body'] = (array) The data frame analytics settings to update (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/update-dfanalytics.html
     */
    public function updateDataFrameAnalytics(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\UpdateDataFrameAnalytics $endpoint */
        $endpoint = $endpointBuilder('Ml\UpdateDataFrameAnalytics');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates certain properties of a datafeed.
     *
     * $params['datafeed_id']        = (string) The ID of the datafeed to update
     * $params['ignore_unavailable'] = (boolean) Ignore unavailable indexes (default: false)
     * $params['allow_no_indices']   = (boolean) Ignore if the source indices expressions resolves to no concrete indices (default: true)
     * $params['ignore_throttled']   = (boolean) Ignore indices that are marked as throttled (default: true)
     * $params['expand_wildcards']   = (enum) Whether source index expressions should get expanded to open or closed indices (default: open) (Options = open,closed,hidden,none,all)
     * $params['body']               = (array) The datafeed update settings (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-update-datafeed.html
     */
    public function updateDatafeed(array $params = [])
    {
        $datafeed_id = $this->extractArgument($params, 'datafeed_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\UpdateDatafeed $endpoint */
        $endpoint = $endpointBuilder('Ml\UpdateDatafeed');
        $endpoint->setParams($params);
        $endpoint->setDatafeedId($datafeed_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates the description of a filter, adds items, or removes items.
     *
     * $params['filter_id'] = (string) The ID of the filter to update
     * $params['body']      = (array) The filter update (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-update-filter.html
     */
    public function updateFilter(array $params = [])
    {
        $filter_id = $this->extractArgument($params, 'filter_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\UpdateFilter $endpoint */
        $endpoint = $endpointBuilder('Ml\UpdateFilter');
        $endpoint->setParams($params);
        $endpoint->setFilterId($filter_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates certain properties of an anomaly detection job.
     *
     * $params['job_id'] = (string) The ID of the job to create
     * $params['body']   = (array) The job update settings (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-update-job.html
     */
    public function updateJob(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\UpdateJob $endpoint */
        $endpoint = $endpointBuilder('Ml\UpdateJob');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Updates certain properties of a snapshot.
     *
     * $params['job_id']      = (string) The ID of the job to fetch
     * $params['snapshot_id'] = (string) The ID of the snapshot to update
     * $params['body']        = (array) The model snapshot properties to update (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-update-snapshot.html
     */
    public function updateModelSnapshot(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $snapshot_id = $this->extractArgument($params, 'snapshot_id');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\UpdateModelSnapshot $endpoint */
        $endpoint = $endpointBuilder('Ml\UpdateModelSnapshot');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setSnapshotId($snapshot_id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Upgrades a given job snapshot to the current major version.
     *
     * $params['job_id']              = (string) The ID of the job
     * $params['snapshot_id']         = (string) The ID of the snapshot
     * $params['timeout']             = (time) How long should the API wait for the job to be opened and the old snapshot to be loaded.
     * $params['wait_for_completion'] = (boolean) Should the request wait until the task is complete before responding to the caller. Default is false.
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/ml-upgrade-job-model-snapshot.html
     */
    public function upgradeJobSnapshot(array $params = [])
    {
        $job_id = $this->extractArgument($params, 'job_id');
        $snapshot_id = $this->extractArgument($params, 'snapshot_id');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\UpgradeJobSnapshot $endpoint */
        $endpoint = $endpointBuilder('Ml\UpgradeJobSnapshot');
        $endpoint->setParams($params);
        $endpoint->setJobId($job_id);
        $endpoint->setSnapshotId($snapshot_id);

        return $this->performRequest($endpoint);
    }

    /**
     * Validates an anomaly detection job.
     *
     * $params['body'] = (array) The job config (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/machine-learning/current/ml-jobs.html
     */
    public function validate(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\Validate $endpoint */
        $endpoint = $endpointBuilder('Ml\Validate');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Validates an anomaly detection detector.
     *
     * $params['body'] = (array) The detector (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/machine-learning/current/ml-jobs.html
     */
    public function validateDetector(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Ml\ValidateDetector $endpoint */
        $endpoint = $endpointBuilder('Ml\ValidateDetector');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}