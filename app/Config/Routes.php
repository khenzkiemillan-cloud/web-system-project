<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// Protected Routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

        // Products Explicit Routes
    $routes->get('products', 'Products::index');
    $routes->get('products/create', 'Products::create');
    $routes->post('products', 'Products::store');
    $routes->get('products/edit/(:num)', 'Products::edit/$1');
    $routes->put('products/(:num)', 'Products::update/$1');
    $routes->delete('products/(:num)', 'Products::delete/$1');

    // Categories Explicit Routes
    $routes->get('categories', 'Categories::index');
    $routes->get('categories/create', 'Categories::create');
    $routes->post('categories', 'Categories::store');
    $routes->get('categories/edit/(:num)', 'Categories::edit/$1');
    $routes->put('categories/(:num)', 'Categories::update/$1');
    $routes->delete('categories/(:num)', 'Categories::delete/$1');

    // Customers Explicit Routes
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/create', 'Customers::create');
    $routes->post('customers', 'Customers::store');
    $routes->get('customers/edit/(:num)', 'Customers::edit/$1');
    $routes->put('customers/(:num)', 'Customers::update/$1');
    $routes->delete('customers/(:num)', 'Customers::delete/$1');

    // Inventory
    $routes->get('inventory', 'Inventory::index');
    $routes->post('inventory/addStock', 'Inventory::addStock');

    // Sales & POS
    $routes->get('sales', 'Sales::index');
    $routes->get('sales/create', 'Sales::create');
    $routes->post('sales/store', 'Sales::store');
    $routes->get('sales/history', 'Sales::history');

  

    // Utang Ledger
    $routes->get('utang', 'Utang::index');
    $routes->get('utang/payment/(:num)', 'Utang::payment/$1');
    $routes->post('utang/pay/(:num)', 'Utang::pay/$1');
    $routes->get('utang/history', 'Utang::history');

    // Reports
    $routes->get('reports/sales', 'Reports::sales_report');
    $routes->get('reports/inventory', 'Reports::inventory_report');
    $routes->get('reports/utang', 'Reports::utang_report');
});