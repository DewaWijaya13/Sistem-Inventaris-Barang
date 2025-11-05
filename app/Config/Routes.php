<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// =================================================================
// PENGATURAN WEB ROUTE KITA
// =================================================================
// Rute ini akan memanggil Controller 'Produk' (web)
// dan fungsi 'index()', yang akan menampilkan file View kita.
$routes->get('produk', 'Produk::index');
// =================================================================


// =================================================================
// PENGATURAN API KITA
// =================================================================
// 'namespace' => 'App\Controllers\Api' memberi tahu CI
// untuk mencari controller di dalam folder Api kita.
$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    
    // Gunakan $routes->resource()
    // Ini akan otomatis membuat rute RESTful yang kita butuhkan:
    // GET    /api/produk           -> Produk::index()
    // GET    /api/produk/(:num)    -> Produk::show($1)
    // POST   /api/produk           -> Produk::create()
    // PUT    /api/produk/(:num)    -> Produk::update($1)
    // DELETE /api/produk/(:num)    -> Produk::delete($1)
    $routes->resource('produk', ['controller' => 'Produk']);

});
// =================================================================