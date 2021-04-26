<?php

$routes->group('profile', ['namespace' => 'Modules\Profile\Controllers'], function($routes)
{
  $routes->get('(:alphanum)', 'Profile::index/$1');
  $routes->post('(:alphanum)/update', 'Profile::update/$1');
});
