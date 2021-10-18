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
  *---------------------------------------------
  * The constant MUST write UpperCase 
  *---------------------------------------------
  **/

 /** Declare constant Path(s) */
 define('ROOT', dirname(dirname(__DIR__)));
 const ROOT_PATH = ROOT;
 const SEPARATOR = '/';

 /** declare main directory */
 const APP_PATH  = ROOT_PATH . SEPARATOR . 'app' . SEPARATOR;
 const CORE_PATH = ROOT_PATH . SEPARATOR . 'core'. SEPARATOR;
 const PUBLIC_PATH = ROOT_PATH . SEPARATOR . 'public' . SEPARATOR;

 /** declare libraries path */
 const LIB_PATH  = CORE_PATH . SEPARATOR . 'libraries'. SEPARATOR;

 /** declare functions path */
 const FUN_PATH = CORE_PATH . SEPARATOR . 'functions' . SEPARATOR;

 /** declare database path */
 const DB_PATH = CORE_PATH . SEPARATOR . 'database' . SEPARATOR;


 /** declare directory inside app */

 const VIEW_PATH = APP_PATH . SEPARATOR . 'view' . SEPARATOR;
 const CONFIG_PATH = APP_PATH . SEPARATOR . 'config' . SEPARATOR;
 const LANG_PATH = APP_PATH . SEPARATOR . 'language' . SEPARATOR;
 const REQUEST_PATH = APP_PATH . SEPARATOR . 'request'. SEPARATOR;

