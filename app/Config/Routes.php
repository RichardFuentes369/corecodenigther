<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group("api", function ($routes) {
    $routes->post("login", "Login::index");

    $routes->post("registerAdmin", "Register::admin");
    $routes->post("registerUser", "Register::user");
    // $routes->get("users", "Usuarios::users", ['filter' => 'authFilter']);
    $routes->get("users", "Usuarios::users");
    $routes->get("admins", "Usuarios::admins");
    $routes->get("user/(:num)", "Usuarios::user/$1");
    $routes->get("admin/(:num)", "Usuarios::admin/$1");
});