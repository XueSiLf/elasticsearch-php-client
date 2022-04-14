<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/12 18:43:42
 */

namespace LavaMusic\ElasticSearch\Utility;

use Swoole\Coroutine\System;

class Core
{
    /**
     * Sleep for the specified amount of time specified in the request's
     * ['client']['delay'] option if present.
     *
     * This function should only be used when a non-blocking sleep is not
     * possible.
     *
     * @param array $request Request to sleep
     */
    public static function doSleep(array $request)
    {
        if (isset($request['client']['delay'])) {
            $delay = intval($request['client']['delay']);
            $delay = $delay > 0 ? $delay : 0;
            if ($delay > 0 && $delay <= 86400) {
                System::sleep($request['client']['delay']);
            }
        }
    }

    public static function url(array $request)
    {
        if (isset($request['url'])) {
            return $request['url'];
        }

        $uri = (isset($request['scheme'])
                ? $request['scheme'] : 'http') . '://';

        if ($host = self::header($request, 'host')) {
            $uri .= $host;
        } else {
            throw new \InvalidArgumentException('No Host header was provided');
        }

        if (isset($request['uri'])) {
            $uri .= $request['uri'];
        }

        if (isset($request['query_string'])) {
            $uri .= '?' . $request['query_string'];
        }

        return $uri;
    }

    /**
     * Gets a header value from a message as a string or null
     *
     * This method searches through the "headers" key of a message for a header
     * using a case-insensitive search. The lines of the header are imploded
     * using commas into a single string return value.
     *
     * @param array $message Request or response hash.
     * @param string $header Header to retrieve
     *
     * @return string|null Returns the header string if found, or null if not.
     */
    public static function header($message, $header)
    {
        $match = self::headerLines($message, $header);
        return $match ? implode(', ', $match) : null;
    }

    /**
     * Gets an array of header line values from a message for a specific header
     *
     * This method searches through the "headers" key of a message for a header
     * using a case-insensitive search.
     *
     * @param array $message Request or response hash.
     * @param string $header Header to retrieve
     *
     * @return array
     */
    public static function headerLines($message, $header)
    {
        $result = [];

        if (!empty($message['headers'])) {
            foreach ($message['headers'] as $name => $value) {
                if (!strcasecmp($name, $header)) {
                    $result = array_merge($result, $value);
                }
            }
        }

        return $result;
    }

    /**
     * Returns the first header value from a message as a string or null. If
     * a header line contains multiple values separated by a comma, then this
     * function will return the first value in the list.
     *
     * @param array $message Request or response hash.
     * @param string $header Header to retrieve
     *
     * @return string|null Returns the value as a string if found.
     */
    public static function firstHeader($message, $header)
    {
        if (!empty($message['headers'])) {
            foreach ($message['headers'] as $name => $value) {
                if (!strcasecmp($name, $header)) {
                    // Return the match itself if it is a single value.
                    $pos = strpos($value[0], ',');
                    return $pos ? substr($value[0], 0, $pos) : $value[0];
                }
            }
        }

        return null;
    }

    /**
     * Reads the body of a message into a string.
     *
     * @param array $message Array containing a "body" key
     *
     * @return null|string Returns the body as a string or null if not set.
     * @throws \InvalidArgumentException if a request body is invalid.
     */
    public static function body($message)
    {
        if (!isset($message['body'])) {
            return null;
        }

        switch (gettype($message['body'])) {
            case 'string':
                return $message['body'];
            case 'resource':
                return stream_get_contents($message['body']);
            case 'object':
                if ($message['body'] instanceof \Iterator) {
                    return implode('', iterator_to_array($message['body']));
                } elseif (method_exists($message['body'], '__toString')) {
                    return (string)$message['body'];
                }
            default:
                throw new \InvalidArgumentException('Invalid request body: '
                    . self::describeType($message['body']));
        }
    }

    /**
     * Rewind the body of the provided message if possible.
     *
     * @param array $message Message that contains a 'body' field.
     *
     * @return bool Returns true on success, false on failure
     */
    public static function rewindBody($message)
    {
        if ($message['body'] instanceof \Generator) {
            return false;
        }

        if ($message['body'] instanceof \Iterator) {
            $message['body']->rewind();
            return true;
        }

        if (is_resource($message['body'])) {
            return rewind($message['body']);
        }

        return is_string($message['body'])
            || (is_object($message['body'])
                && method_exists($message['body'], '__toString'));
    }

    /**
     * Debug function used to describe the provided value type and class.
     *
     * @param mixed $input
     *
     * @return string Returns a string containing the type of the variable and
     *                if a class is provided, the class name.
     */
    public static function describeType($input)
    {
        switch (gettype($input)) {
            case 'object':
                return 'object(' . get_class($input) . ')';
            case 'array':
                return 'array(' . count($input) . ')';
            default:
                ob_start();
                var_dump($input);
                // normalize float vs double
                return str_replace('double(', 'float(', rtrim(ob_get_clean()));
        }
    }

    /**
     * Returns true if a message has the provided case-insensitive header.
     *
     * @param array $message Request or response hash.
     * @param string $header Header to check
     *
     * @return bool
     */
    public static function hasHeader($message, $header)
    {
        if (!empty($message['headers'])) {
            foreach ($message['headers'] as $name => $value) {
                if (!strcasecmp($name, $header)) {
                    return true;
                }
            }
        }

        return false;
    }
}