<?php

$routes->group('files',['namespace' => 'Modules\Files\Controllers'], function($routes)
{
  $routes->get('/', 'Files::index');
  $routes->match(['get', 'post'], 'add', 'Files::add');
});

// member routes
$routes->get('(:alphanum)/files', '\Modules\Files\Controllers\Files::member/$1');
$routes->match(['get', 'post'], '(:alphanum)/files/add', '\Modules\Files\Controllers\Files::memberAdd/$1');
$routes->get('(:alphanum)/files/delete/(:num)', '\Modules\Files\Controllers\Files::delete/$1/$2');
