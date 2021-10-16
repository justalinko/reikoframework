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
/**
 * @see https://github.com/bramus/router
 */
$router = new \Bramus\Router\Router();

$router->setNamespace('\Reiko\App');




/** set router here */
$router->get('/' ,'IndexHandler@index');





/** end set router */

/** run  */
$router->run();