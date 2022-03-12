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
define('ROOT_PATH', ROOT);
define('SEPARATOR', '/');

/** declare main directory */
define('APP_PATH', ROOT_PATH . SEPARATOR . 'app' . SEPARATOR);
define('CORE_PATH', ROOT_PATH . SEPARATOR . 'core' . SEPARATOR);
define('PUBLIC_PATH', ROOT_PATH . SEPARATOR . 'public' . SEPARATOR);

/** declare libraries path */
define('LIB_PATH', CORE_PATH . SEPARATOR . 'libraries' . SEPARATOR);

/** declare functions path */
define('FUN_PATH', CORE_PATH . SEPARATOR . 'functions' . SEPARATOR);

/** declare database path */
define('DB_PATH', CORE_PATH . SEPARATOR . 'database' . SEPARATOR);


/** declare directory inside app */

define('VIEW_PATH', APP_PATH . SEPARATOR . 'view' . SEPARATOR);
define('CONFIG_PATH', APP_PATH . SEPARATOR . 'config' . SEPARATOR);
define('LANG_PATH', APP_PATH . SEPARATOR . 'language' . SEPARATOR);
define('REQUEST_PATH', APP_PATH . SEPARATOR . 'request' . SEPARATOR);
define('HANDLER_PATH', APP_PATH . SEPARATOR . 'handler' . SEPARATOR);
