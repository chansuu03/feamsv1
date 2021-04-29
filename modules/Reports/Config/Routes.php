<?php

$routes->group('reports', ['namespace' => 'Modules\Reports\Controllers'], function($routes)
{
  $routes->get('login', 'LoginReports::index');
  $routes->get('login/print', 'LoginReports::print');
});
