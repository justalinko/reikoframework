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

class Config
{
    public $config;
    private $config_list;

    public function register_config()
    {
        /**
         * You can call the config files in 'app/config/'
         * This addtional config besides of .env files.
         */
        $this->config_list = [
            'config',
            'routes'
        ];
    }

    public function init()
    {
        $this->register_config();
        foreach ($this->config_list as $config_file) {
            /** check config file exist */
            if (file_exists(CONFIG_PATH . $config_file . '.php')) {
                /** include registered config file */
                require_once(CONFIG_PATH . $config_file . '.php');
            } else {
                exit('ERROR : Config ' . $config_file . ' not exist !');
            }
        }

        /** declare $config to constant  */
        define('CONFIG' , $config);
        
        /** declare $config to $this->config */
        $this->config = $config;
    }
}
