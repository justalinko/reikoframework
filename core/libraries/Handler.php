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

class Handler{
   
    private $latte;
    /** handler construct
     *  You can call functions or library here.
     */
    public function __construct()
    {
        /** load some functions */
        $this->use_fun_array(CONFIG['load_functions']);
        
        /** load latte template engine */
        $this->latte = new \Latte\Engine;
        $this->latte->setTempDirectory(APP_PATH . 'cache');
       

    }

    public function run(){
    
        $this->load_DBfun();
        $this->load_appHandler();
    
    }
    public function view($view , $params = [])
    {
        
        if(file_exists(VIEW_PATH . $view . '.latte.php')){
            return $this->latte->render(VIEW_PATH . $view . '.latte.php' , $params);
        }else{
            exit(" Template not exists !");
        }
    }
    public function use_fun($functions)
    {
        if(file_exists(FUN_PATH . $functions .'.php'))
        {
            require_once FUN_PATH . $functions .'.php';
        }else{

            exit('FUNCTIONS : '.$functions . ' Doesn\'t exists !');
        }
    }
    public function use_fun_array($arr)
    {
        if(is_array($arr))
        {
            foreach($arr as $fun)
            {
                $this->use_fun($fun);
            }
        }
    }
    
    public function load_appHandler(){

        spl_autoload_register(function($class){
            $ex = explode("\\" , $class);
            $class = end($ex);
            if(file_exists(APP_PATH . 'handler/' . $class . '.php')){
             require_once APP_PATH .'handler/'.$class .'.php';
            }
        });
    }

    public function load_DBfun()
    {
        spl_autoload_register(function($class)
        {
            $ex = explode("\\" , $class);
            $class = end($ex);
            if(file_exists(APP_PATH . $class.'.dbfun.php'))
            {
                require_once APP_PATH .$class .'.dbfun.php';
            }
        });
    }
}