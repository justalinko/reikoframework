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

use Reiko\Libraries\Config;
use Reiko\Libraries\DB;
use Reiko\Libraries\Handler;


class Bootstrap
{

    private $load;
    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
        $dotenv->load();


        $dbhost = $_ENV['DB_HOSTNAME'];
        $dbuser = $_ENV['DB_USERNAME'];
        $dbpass = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];
        ORM::configure("mysql:host=$dbhost;dbname=$dbname");
        ORM::configure("username", $dbuser);
        ORM::configure("password", $dbpass);
    }
    public function load_libraries()
    {
        foreach (CONFIG['load_libraries'] as $lib) {
            $className = @end(@explode("\\", $lib));
            if (file_exists(LIB_PATH . $className . '.php')) {
                require_once LIB_PATH . $className . '.php';
            } else {
                exit('LIBRARY : ' . $lib . ' Doesn\'t exists !');
            }
        }
    }
    public function load_dbfun()
    {
        spl_autoload_register(function ($class) {
            $name = @end(@explode("\\", $class));
            if (file_exists(APP_PATH . $name . '.dbfun.php')) {
                require_once APP_PATH . $name . '.dbfun.php';
            }
        });
    }
    public function use_fun($functions)
    {
        if (file_exists(FUN_PATH . $functions . '.php')) {
            require_once FUN_PATH . $functions . '.php';
        } else {

            exit('FUNCTIONS : ' . $functions . ' Doesn\'t exists !');
        }
    }
    public function use_fun_array($arr)
    {
        if (is_array($arr)) {
            foreach ($arr as $fun) {
                $this->use_fun($fun);
            }
        }
    }

    public function run()
    {

        /** load some functions */
        $this->use_fun_array(CONFIG['load_functions']);
        $this->load_libraries();
        (new Handler)->run();
        $this->load_dbfun();

        require CONFIG_PATH . '/routes.php';
    }
}
