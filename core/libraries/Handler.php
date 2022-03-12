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

class Handler
{

    private $latte;
    /** handler construct
     *  You can call functions or library here.
     */
    public function __construct()
    {


        /** load latte template engine */
        $this->latte = new \Latte\Engine;
        $this->latte->setTempDirectory(APP_PATH . 'cache');
    }

    public function run()
    {


        $this->load_appHandler();
    }
    public function view($view, $params = [])
    {

        if (file_exists(VIEW_PATH . $view . '.latte.php')) {
            return $this->latte->render(VIEW_PATH . $view . '.latte.php', $params);
        } else {
            exit(" Template not exists !");
        }
    }


    public function load_appHandler()
    {

        spl_autoload_register(function ($class) {
            $ex = explode("\\", $class);
            $class = end($ex);
            if (file_exists(APP_PATH . 'handler/' . $class . '.php')) {
                require_once APP_PATH . 'handler/' . $class . '.php';
            }
        });
    }
}
