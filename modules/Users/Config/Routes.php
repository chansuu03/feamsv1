<?php

$routes->group('users', ['filter' => 'admin', 'namespace' => 'Modules\Users\Controllers'], function($routes)
{
  $routes->get('active', 'Users::index');
  $routes->match(['get', 'post'], 'add', 'Users::add');
  $routes->get('(:alphanum)', 'Users::details/$1');
  $routes->get('delete/(:num)', 'Users::delete/$1');
  $routes->get('status/(:num)', 'Users::status/$1');
});
