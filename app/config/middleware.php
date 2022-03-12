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
 * You can register your middleware here.
 */

$registerMiddleware = [
    [
        'method' => 'POST|GET',
        'scope'  => '/admin/.*',
        'rule'   => function () {
            if (!isset($_SESSION['admin'])) {
                echo "Forbidden";
                exit;
            }
        }
    ],

    [
        'method' => 'POST|GET',
        'scope'  => '/user/.*',
        'rule'   => function () {
            if (!isset($_SESSION['user'])) {
                echo "Forbidden";
                exit;
            }
        }
    ]
];
