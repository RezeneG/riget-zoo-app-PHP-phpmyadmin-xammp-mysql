<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/auth.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($uri === '/rza_project/public/api/tickets/book') {
    require __DIR__ . '/../src/booking_ticket.php'; exit;
} elseif ($uri === '/rza_project/public/api/register') {
    require __DIR__ . '/../src/register.php'; exit;
} elseif ($uri === '/rza_project/public/api/login') {
    require __DIR__ . '/../src/login.php'; exit;
} elseif ($uri === '/rza_project/public/api/hotel/book') {
    require __DIR__ . '/../src/hotel_book.php'; exit;
} elseif ($uri === '/rza_project/public/api/admin/bookings') {
    require __DIR__ . '/../src/admin_bookings.php'; exit;
} else {
    // serve static demo page
    if ($uri === '/rza_project/public/' || $uri === '/rza_project/public/index.php' || $uri === '/rza_project/public') {
        readfile(__DIR__ . '/index.html'); exit;
    }
    http_response_code(404); echo json_encode(['error'=>'not found','uri'=>$uri]); exit;
}