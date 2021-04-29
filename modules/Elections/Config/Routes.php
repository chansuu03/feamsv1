<?php 

$routes->group('elections', ['namespace' => 'Modules\Elections\Controllers'], function($routes)
{
    $routes->get('candidates', 'Candidates::index');
    $routes->post('candidates/add', 'Candidates::add');
    $routes->get('candidates/del/(:num)', 'Candidates::delete/$1');
    
    $routes->get('positions', 'Positions::index');
    $routes->post('positions/add', 'Positions::add');
    $routes->get('positions/del/(:num)', 'Positions::delete/$1');

    $routes->get('voting', 'Election::index');
    $routes->post('vote', 'Election::castVote');
});