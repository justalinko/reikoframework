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
require __DIR__ . '/middleware.php';
$router = new \Bramus\Router\Router();

foreach ($registerMiddleware as $middleware) {
    $router->before($middleware['method'], $middleware['scope'], $middleware['rule']);
}

$router->setNamespace('\Reiko\App');




/** set router here */
$router->get('/', 'IndexHandler@index');
$router->get('/db-test', 'IndexHandler@get_db');


$router->post('/login', 'AuthHandler@login');
$router->post('/register', 'AuthHandler@register');

$router->mount('/product', function () use ($router) {
    $router->get('/', 'ProductHandler@all');
    $router->get('/(\d+)', 'ProductHandler@detail');
});

$router->mount('/post', function () use ($router) {
    $router->get('/', 'PostHandler@all');
    $router->get('/(\d+)', 'PostHandler@detail');
});

$router->mount('/category', function () use ($router) {
    $router->get('/', 'CategoryHandler@all');
    $router->get('/(\d+)', 'CategoryHandler@detail');
});

$router->mount('/admin', function () use ($router) {

    $router->delete('/product/(\d+)', 'ProductHandler@destroy');
    $router->delete('/post/(\d+)', 'PostHandler@destroy');
    $router->delete('/category/(\d+)', 'CategoryHandler@destroy');
    $router->delete('/user/(\d+)', 'UserHandler@destroy');
});


/** end set router */

/** run  */
$router->run();
