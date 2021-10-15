<?php

namespace Reiko\Libraries;

class Request
{

    /**
     * @method request
     * @return void
     */
    public function request()
    {

        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * @method is_post
     * @return bool
     */
    public function is_post(): bool
    {

        if ($this->request() == 'POST') {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @method is_get
     * @return bool
     */
    public function is_get(): bool
    {

        if ($this->request() == 'GET') {
            return true;
        } else {

            return false;
        }
    }

    /**
     * @method input
     * @return void
     */
    public function input($var)
    {
        if ($this->is_post()) {
            if (in_array($var, $_POST)) {
                return $_POST['' . $var . ''];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    /**
     * @method getInputAll
     * @return Array
     */
    public function getInputAll()
    {
        if ($this->is_post()) {
            return $_POST;
        } else {
            return [];
        }
    }
    /**
     * @method params
     * @return void
     */
    public function param($var)
    {

        if ($this->is_get()) {
            if (in_array($var, $_GET)) {
                return $_GET['' . $var . ''];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    /**
     * @method getParamAll
     * @return Array
     */
    public function getParamAll()
    {
        if ($this->is_get()) {
            return $_GET;
        } else {
            return [];
        }
    }
}
