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

class Request
{

    /**
     * @method request
     * @return void
     */
    public static function request()
    {

        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * @method is_post
     * @return bool
     */
    public static function is_post(): bool
    {

        if (self::request() == 'POST') {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @method is_get
     * @return bool
     */
    public static function is_get(): bool
    {

        if (self::request() == 'GET') {
            return true;
        } else {

            return false;
        }
    }

    /**
     * @method is_file
     * @return bool
     */
    public static function is_file(): bool
    {
        if (isset($_FILES)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @method file_name
     * @return void
     */
    public static function file_name($name)
    {
        if (self::is_file()) {
            return $_FILES['' . $name . '']['name'];
        } else {
            return null;
        }
    }

    public static function file_tmp($name)
    {
        if (self::is_file()) {
            return $_FILES['' . $name . '']['tmp_name'];
        } else {
            return null;
        }
    }

    /**
     * @method input
     * @return void
     */
    public static function input($var)
    {
        if (self::is_post()) {
            return $_POST['' . $var . ''];
        } else {
            return null;
        }
    }
    /**
     * @method getInputAll
     * @return Array
     */
    public static function getInputAll()
    {
        if (self::is_post()) {
            return $_POST;
        } else {
            return [];
        }
    }
    /**
     * @method params
     * @return void
     */
    public static function param($var)
    {

        if (self::is_get()) {
            return $_GET['' . $var . ''];
        } else {
            return null;
        }
    }
    /**
     * @method getParamAll
     * @return Array
     */
    public static function getParamAll()
    {
        if (self::is_get()) {
            return $_GET;
        } else {
            return [];
        }
    }
}
