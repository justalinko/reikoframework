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
session_start();
define('REIKO_START', microtime());
require_once '../vendor/autoload.php';
require_once '../app/config/constant.php';
require_once '../app/config/config.php';
require_once '../core/Bootstrap.php';
$REIKO = new Bootstrap;
$REIKO->run();
