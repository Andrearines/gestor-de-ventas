<?php
require_once __DIR__ . '/../config/app.php';

use controllers\AdminController;
use controllers\EventController;
use controllers\VendorController;
use controllers\AuthController;
use controllers\API\API;
use MVC\Router;

$r = new Router;

// Pages
$r->get("/", [controllers\PagesController::class, 'indexView']);

// Auth
$r->get("/auth/login", [AuthController::class, 'login']);
$r->post("/auth/login", [AuthController::class, 'login']);
$r->get("/auth/register", [AuthController::class, "register"]);
$r->post("/auth/register", [AuthController::class, "register"]);
$r->get("/auth/logout", [AuthController::class, 'logout']);

// Admin
$r->get("/admin/dashboard", [AdminController::class, 'index'], ["admin"]);
$r->get("/admin/events", [EventController::class, 'index'], ["admin"]);
$r->get("/admin/events/create", [EventController::class, 'create'], ["admin"]);
$r->post("/admin/events/create", [EventController::class, 'create'], ["admin"]);
$r->get("/admin/events/edit", [EventController::class, 'edit'], ["admin"]);
$r->post("/admin/events/edit", [EventController::class, 'edit'], ["admin"]);
$r->get("/admin/events/detail", [EventController::class, 'detail'], ["admin"]);
$r->get("/admin/tickets", [AdminController::class, 'tickets'], ["admin"]);
$r->get("/admin/combos", [AdminController::class, 'combos'], ["admin"]);
$r->get("/admin/teams", [AdminController::class, 'teams'], ["admin"]);
$r->get("/admin/sales", [AdminController::class, 'sales'], ["admin"]);
$r->get("/admin/reservations", [AdminController::class, 'reservations'], ["admin"]);

// Vendor
$r->get("/vendor/dashboard", [VendorController::class, 'index'], ["vendor"]);
$r->get("/vendor/sales", [VendorController::class, 'sales'], ["vendor"]);
$r->get("/vendor/reservations", [VendorController::class, 'reservations'], ["vendor"]);
$r->get("/vendor/tickets", [VendorController::class, 'tickets'], ["vendor"]);
$r->get("/vendor/stats", [VendorController::class, 'stats'], ["vendor"]);


//API
$r->post("/api/events/delete", [API::class, 'deleteEvent'], ["admin"]);

$r->post("/api/teams/create", [API::class, 'CrearTeam'], ["admin"]);
$r->post("/api/teams/update", [API::class, 'updateTeam'], ["admin"]);
$r->post("/api/teams/delete", [API::class, 'deleteTeam'], ["admin"]);

$r->post("/api/members/create", [API::class, 'CrearMember'], ["admin"]);
$r->post("/api/members/update", [API::class, 'updateMember'], ["admin"]);
$r->post("/api/members/delete", [API::class, 'deleteMember'], ["admin"]);
$r->Rutas();
