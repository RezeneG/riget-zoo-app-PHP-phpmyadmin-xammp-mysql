<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_json();
$input = json_input();
if (!$input || !isset($input['email']) || !isset($input['password'])) {
    http_response_code(400); echo json_encode(['error'=>'email & password required']); exit;
}
$email = filter_var($input['email'], FILTER_VALIDATE_EMAIL);
if (!$email) { http_response_code(400); echo json_encode(['error'=>'invalid email']); exit; }
$pass = password_hash($input['password'], PASSWORD_DEFAULT);
$full = $input['full_name'] ?? null;
try {
    $stmt = $pdo->prepare('INSERT INTO users (email, password_hash, full_name) VALUES (?, ?, ?)');
    $stmt->execute([$email, $pass, $full]);
    echo json_encode(['ok'=>true, 'user_id'=>$pdo->lastInsertId()]);
} catch (Exception $e) {
    http_response_code(500); echo json_encode(['error'=>'registration failed','detail'=>$e->getMessage()]);
}