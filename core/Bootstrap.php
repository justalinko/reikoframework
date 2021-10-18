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
        ORM::configure("username",$dbuser);
        ORM::configure("password",$dbpass);
    }
    public function load( $lib)
    {
        $exp = explode("\\" , $lib);
        $file = end($exp);
        if(file_exists(LIB_PATH . $file. '.php')){
        require_once LIB_PATH. $file.'.php';
        }
    }
    private function register_lib()
    {
        spl_autoload_register(function($class)
        {
            $this->load($class);
        });
    }
    public function run(){

        $this->register_lib();
        
        $config = new Config;
        $config->init();
        $handler = new Handler;
        $handler->run();
    
        require CONFIG_PATH . '/routes.php';

        
    }
   
}
