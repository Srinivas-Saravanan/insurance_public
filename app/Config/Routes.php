<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/payment','Paytm::index');
$routes->post('/check',"Auth::check");
$routes->get('/logout',"Auth::logout");
$routes->group('', ['filter' => 'AuthFilter'], function($routes) {
    $routes->match(['get', 'post'], 'home/home', 'Auth::home',['filter'=>'EmpFilter']);
    $routes->post('home/filter',"Auth::filter",['filter'=>'EmpFilter']);
    $routes->get('home/view/(:num)',"Auth::view/$1");
    $routes->get('home/editAdd/(:num)',"Auth::editAdd/$1");
    $routes->get('home/editAdd/(:num)/(:any)',"Auth::editAdd/$1/$2");
    $routes->post('home/delete/(:num)/(:any)',"Auth::delete/$1/$2");
    $routes->post('home/edAdder/(:num)/(:any)', 'Auth::edAdder/$1/$2');
    $routes->post('home/edAdder/(:num)', 'Auth::edAdder/$1');
    $routes->get('home/getRules/(:num)','Auth::getRules/$1',['filter'=>'EmpFilter']);
    $routes->get('home/valid','Auth::valid',['filter'=>'EmpFilter']);
    $routes->get('home/rules','Auth::rules',['filter'=>'EmpFilter']);
    $routes->get('home/dashboard2','Auth::dashboard',['filter'=>'EmpFilter']);
    $routes->get('home/ruler/(:num)','Auth::ruler/$1',['filter'=>'EmpFilter']);
    $routes->post('home/saveRules','Auth::saveRules',['filter'=>'EmpFilter']);
    $routes->get('home/newFam','Auth::newFam',['filter'=>'EmpFilter']);
    $routes->post('home/valFam','Auth::valFam',['filter'=>'EmpFilter']);
    $routes->post('home/saveFam','Auth::saveFam',['filter'=>'EmpFilter']);

});