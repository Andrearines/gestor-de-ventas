<?php
require_once __DIR__ . '/../config/app.php';

use controllers\AdminController;
use controllers\EventController;
use controllers\VendorController;
use controllers\AuthController;
use MVC\Router;

$r = new Router;

// Pages
$r->get("/", [controllers\PagesController::class, 'indexView']);

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
$r->get("/admin/combos", [AdminController::class, 'combos']);
$r->get("/admin/teams", [AdminController::class, 'teams']);
$r->get("/admin/sales", [AdminController::class, 'sales']);
$r->get("/admin/reservations", [AdminController::class, 'reservations']);

// Vendor
$r->get("/vendor/dashboard", [VendorController::class, 'index']);
$r->get("/vendor/sales", [VendorController::class, 'sales']);
$r->get("/vendor/reservations", [VendorController::class, 'reservations']);
$r->get("/vendor/tickets", [VendorController::class, 'tickets']);
$r->get("/vendor/stats", [VendorController::class, 'stats']);


$r->Rutas();
