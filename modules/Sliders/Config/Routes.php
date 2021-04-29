<?php

$routes->group('sliders',['namespace' => 'Modules\Sliders\Controllers'], function($routes)
{
  $routes->get('/', 'Sliders::index');
  $routes->match(['get', 'post'], 'add', 'Sliders::add');
  $routes->get('delete/(:num)', 'Sliders::delete/$1');
});