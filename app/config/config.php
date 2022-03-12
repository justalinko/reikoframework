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




/** load functions */
$config['load_functions'] = ['common', 'helper', 'array', 'filesystem', 'form'];

/** load libraries */
$config['load_libraries'] = [
    \Reiko\Libraries\DB::class,
    \Reiko\Libraries\Handler::class,
    \Reiko\Libraries\Request::class,
    \Reiko\Libraries\Response::class,
    \Reiko\Libraries\Security::class,
    \Reiko\Libraries\Str::class,
    \Reiko\Libraries\Curl::class,
    \Reiko\Libraries\Schema::class
];
/** default language */
$config['default_lang'] = 'en';


define('CONFIG', $config);
