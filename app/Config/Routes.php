<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('produk', 'Produk::index');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {

    $routes->resource('produk', ['controller' => 'Produk']);

});
