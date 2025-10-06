<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_json();
$input = json_input();
if (!$input || !isset($input['email']) || !isset($input['password'])) {
    http_response_code(400); echo json_encode(['error'=>'email & password required']); exit;
}
$stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE email = ?');
$stmt->execute([$input['email']]);
$user = $stmt->fetch();
if (!$user || !password_verify($input['password'], $user['password_hash'])) {
    http_response_code(401); echo json_encode(['error'=>'invalid credentials']); exit;
}
// Simple session-based auth
session_start();
$_SESSION['user_id'] = $user['id'];
echo json_encode(['ok'=>true, 'user_id'=>$user['id']]);