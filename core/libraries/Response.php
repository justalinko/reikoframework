<?php

/**
 * REIKO FRAMEWORK 
 *  
 * @package ReiKo Framework
 *
 * @author alinko <alinkokomansuby@gmail.com>
 * @author ReiYan <hariyantoriyan.hr@gmail.com>
 * @copyright (c) 2021 
 * 
 * @license MIT 
 * 
 */

namespace Reiko\Libraries;


class Response
{

    public function __construct($header = 200)
    {
        @header('HTTP/1.1 ' . $header . ' ');
    }
    /**
     * @method json
     *
     * @param  array   $data
     * @param  boolean $pretty
     * @return void
     */
    public static function json($data = array(), $pretty = true)
    {
        if ($pretty == true) {
            print json_encode($data, JSON_PRETTY_PRINT);
        } else {
            print json_encode($data);
        }
    }
    /**
     * @method   apiBuilder
     *
     * @param  array   $data
     * @param  string  $message
     * @param  boolean $success
     * @param  boolean $error
     * @return void
     */
    public static function apiBuilder($data = [], $message = null, $success = true, $error = false)
    {
        @header('Content-Type: application/json');

        $payload['success'] = $success;
        $payload['error']   = $error;
        $payload['message'] = $message;
        $payload['data'] = $data;

        return self::json($payload, true);
    }

    /**
     * @method download
     *
     * @param  string $file
     * @return void
     */
    public static function download($file)
    {
        @header('Content-Type: application/octet-stream');
        @header("Content-Transfer-Encoding: Binary");
        @header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
        @readfile($file);
        exit;
    }

    /**
     * @method text
     * @param $string
     * TODO : Output response with text documents.
     */
    public static function text($string)
    {
        @header('Content-Type: text/txt');
        return $string;
    }

    /**
     * @method html
     * @param $string
     * TODO : Output response with html
     * ! $string must be html tags.
     */
    public static function html($string)
    {
        @header('Content-Type: text/html');
        return $string;
    }

    /**
     * @method array
     * @param $json
     * TODO : Parse JSON string to Array
     * ! $json must be JSON String.
     */
    public static function array($json)
    {
        $data = json_decode($json, true);
        print_r($data);
    }
}
