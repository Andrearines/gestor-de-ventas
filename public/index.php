<?php
require_once __DIR__ . '/../config/app.php';

use controllers\PagesController;
use MVC\Router;

$r = new Router;

// Auth
$r->get("/auth/login", [\controllers\AuthController::class, 'login']);
$r->post("/auth/login", [\controllers\AuthController::class, 'login']);
$r->get("/auth/logout", [\controllers\AuthController::class, 'logout']);

// Admin
$r->get("/admin/dashboard", [\controllers\AdminController::class, 'index'], ['admin']);
$r->get("/admin/events", [\controllers\EventController::class, 'index'], ['admin']);
$r->get("/admin/events/create", [\controllers\EventController::class, 'create'], ['admin']);
$r->get("/admin/events/detail", [\controllers\EventController::class, 'detail'], ['admin']);
$r->get("/admin/tickets", [\controllers\AdminController::class, 'tickets'], ['admin']);

// Vendor
$r->get("/vendor/dashboard", [\controllers\VendorController::class, 'index'], ['vendedor']);
$r->get("/vendor/sales", [\controllers\VendorController::class, 'sales'], ['vendedor']);

// Home
$r->get("/", [\controllers\PagesController::class, 'indexView']);

$r->Rutas();
