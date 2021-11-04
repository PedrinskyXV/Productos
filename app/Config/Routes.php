<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Inicio::Login');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

$routes->post('autentificar', 'Inicio::autentificar');
$routes->get('401', 'Inicio::NoAuth');

/* $routes->get('logout', 'Inicio::logout', ['filter' => 'authGuard']);

$routes->get('index', 'Inicio::index', ['filter' => 'authGuard']);
$routes->get('producto/agregar', 'Producto::agregar', ['filter' => 'authGuard']);
$routes->post('producto/insertar', 'Producto::insertar', ['filter' => 'authGuard']);

$routes->get('producto/eliminar/(:num)', 'Producto::eliminar/$1', ['filter' => 'authGuard']);
$routes->get('producto/editar/(:num)', 'Producto::editar/$1', ['filter' => 'authGuard']);
$routes->post('producto/modificar', 'Producto::modificar', ['filter' => 'authGuard']);
$routes->get('producto/darDeBaja/(:num)', 'Producto::darDeBaja/$1', ['filter' => 'authGuard']);
$routes->get('producto/darDeAlta/(:num)', 'Producto::darDeAlta/$1', ['filter' => 'authGuard']); */

$routes->get('logout', 'Inicio::logout', ['filter' => 'authGuard']);

$routes->group('admin', ['filter' => 'authGuard:admin'], function ($routes) {
    $routes->get('index', 'Inicio::Index');
    
    $routes->get('producto/index', 'Producto::Index');    
    $routes->get('producto/agregar', 'Producto::agregar');
    $routes->get('producto/editar/(:num)', 'Producto::editar/$1');

    $routes->get('reporte/productosPDF', 'PDF::productosPDF');

    $routes->get('producto/eliminar/(:num)', 'Producto::eliminar/$1');
    $routes->post('producto/insertar', 'Producto::insertar');
    $routes->post('producto/modificar', 'Producto::modificar');
    $routes->get('producto/darDeBaja/(:num)', 'Producto::darDeBaja/$1');
    $routes->get('producto/darDeAlta/(:num)', 'Producto::darDeAlta/$1');

    $routes->get('marca/index', 'Marca::Index');    
    $routes->get('marca/agregar', 'Marca::agregar');
    $routes->get('marca/editar/(:num)', 'Marca::editar/$1');
    

    $routes->get('marca/eliminar/(:num)', 'Marca::eliminar/$1');
    $routes->post('marca/insertar', 'Marca::insertar');
    $routes->post('marca/modificar', 'Marca::modificar');
    $routes->get('marca/darDeBaja/(:num)', 'Marca::darDeBaja/$1');
    $routes->get('marca/darDeAlta/(:num)', 'Marca::darDeAlta/$1');
});
