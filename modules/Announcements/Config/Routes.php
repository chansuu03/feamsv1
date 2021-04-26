<?php

$routes->group('announcements',['namespace' => 'Modules\Announcements\Controllers'], function($routes)
{
  $routes->get('/', 'Announcements::index');
  $routes->get('(:num)', 'Announcements::details/$1');
  $routes->get('delete/(:num)', 'Announcements::delete/$1');
  $routes->match(['get', 'post'], 'add', 'Announcements::add');
  $routes->post('edit', 'Announcements::edit');
});
