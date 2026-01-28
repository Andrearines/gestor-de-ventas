<?php
require_once __DIR__ . '/../config/app.php';

use controllers\AdminController;
use controllers\EventController;
use controllers\VendorController;
use controllers\AuthController;
use MVC\Router;

$r = new Router;

// Auth
$r->get("/auth/login", [AuthController::class, 'login']);
$r->post("/auth/login", [AuthController::class, 'login']);
$r->get("/auth/logout", [AuthController::class, 'logout']);

// Admin
$r->get("/admin/dashboard", [AdminController::class, 'index']);
$r->get("/admin/events", [EventController::class, 'index']);
$r->get("/admin/events/create", [EventController::class, 'create']);
$r->get("/admin/events/detail", [EventController::class, 'detail']);
$r->get("/admin/tickets", [AdminController::class, 'tickets']);

// Vendor
$r->get("/vendor/dashboard", [VendorController::class, 'index']);
$r->get("/vendor/sales", [VendorController::class, 'sales']);


$r->Rutas();
