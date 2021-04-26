<?php

$routes->group('sliders',['filter' => 'admin', 'namespace' => 'Modules\Sliders\Controllers'], function($routes)
{
  $routes->get('/', 'Sliders::index');
  $routes->match(['get', 'post'], 'add', 'Sliders::add');
});