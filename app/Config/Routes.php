<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. Rute Halaman Utama
// Mengarahkan pengguna yang membuka alamat utama ke halaman login.
$routes->get('/', 'Auth::login');

// 2. Rute untuk Autentikasi (Publik, tidak perlu login)
$routes->get('/register', 'Auth::register');        // Menampilkan form register
$routes->post('/register', 'Auth::postRegister');   // Memproses data register
$routes->get('/login', 'Auth::login');              // Menampilkan form login
$routes->post('/dologin', 'Auth::postDologin');     // Memproses data login (INI YANG PALING PENTING UNTUK MASALAH ANDA)
$routes->get('/logout', 'Auth::getDestroy');        // Memproses logout

// 3. Rute yang Dilindungi (Harus login untuk mengakses)
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Rute Dashboard
    $routes->get('dashboard', 'Dashboard::index');

    // Rute untuk Manajemen Tugas
    $routes->get('tugas', 'Tugas::index');
    $routes->get('tugas/create', 'Tugas::create');
    $routes->post('tugas/store', 'Tugas::store');
    $routes->get('tugas/edit/(:num)', 'Tugas::edit/$1');
    $routes->post('tugas/update/(:num)', 'Tugas::update/$1');
    $routes->get('tugas/delete/(:num)', 'Tugas::delete/$1');
    $routes->get('tugas/selesai', 'Tugas::selesai');
});