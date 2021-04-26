<?php

$routes->group('users', ['namespace' => 'Modules\Users\Controllers'], function($routes)
{
  $routes->get('/', 'Users::index');
  $routes->match(['get', 'post'], 'add', 'Users::add');
  $routes->get('(:alphanum)', 'Users::details/$1');
  $routes->get('delete/(:num)', 'Users::delete/$1');
  $routes->get('status/(:num)', 'Users::status/$1');
});
