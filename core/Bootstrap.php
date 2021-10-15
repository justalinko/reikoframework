<?php
/**
 * REIKO FRAMEWORK 
 *  
 * @package ReiKo Framework
 *
 * @author alinko <alinkokomansuby@gmail.com>
 * @author ReiYan <hariyantoriyan.hr@gmail>
 * @copyright (c) 2021 
 * 
 * @license MIT 
 * 
 */

use Reiko\Libraries\Handler;


class Bootstrap
{
    public $route;
    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
        $dotenv->load();
        
        $this->load_library();
        $this->handler = new Handler;
    }
    public function load_library()
    {

        spl_autoload_register(function ($class) {
            $ex = explode("\\", $class);
            $class = end($ex);
            if (file_exists(LIB_PATH . $class . '.php')) {
                require_once LIB_PATH . $class . '.php';
            }
        });
    }
    public function load_configFiles()
    {
        $dir = CONFIG_PATH;
        $files = glob($dir . '/*.php');

        foreach ($files as $file) {
            require($file);
        }
    }
    public function run()
    {
        $this->handler->run();

        $this->load_configFiles();

    }
}
