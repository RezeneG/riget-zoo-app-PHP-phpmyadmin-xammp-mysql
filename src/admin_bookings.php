<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
session_start();
if (empty($_SESSION['user_id'])) { http_response_code(401); echo json_encode(['error'=>'not logged in']); exit; }
if (!is_admin($pdo, $_SESSION['user_id'])) { http_response_code(403); echo json_encode(['error'=>'admin required']); exit; }

// For demo, allow query param ?list=1 to list bookings
if (isset($_GET['list'])) {
    $stmt = $pdo->query('SELECT b.*, u.email FROM bookings b LEFT JOIN users u ON b.user_id = u.id ORDER BY b.created_at DESC LIMIT 200');
    $rows = $stmt->fetchAll();
    echo json_encode(['ok'=>true,'bookings'=>$rows]); exit;
}
// Update booking status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['booking_id']) || !isset($input['status'])) { http_response_code(400); echo json_encode(['error'=>'booking_id & status']); exit; }
    $stmt = $pdo->prepare('UPDATE bookings SET status = ? WHERE id = ?');
    $stmt->execute([$input['status'], $input['booking_id']]);
    echo json_encode(['ok'=>true]);
    exit;
}
echo json_encode(['ok'=>true,'message'=>'admin endpoint']);