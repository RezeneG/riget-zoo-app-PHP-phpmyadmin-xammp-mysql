<?php
function json_input() {
    $raw = file_get_contents('php://input');
    return json_decode($raw, true);
}

function require_json() {
    header('Content-Type: application/json');
}

// Simple sanitiser
function san($s) {
    return is_string($s) ? trim(htmlspecialchars($s, ENT_QUOTES, 'UTF-8')) : $s;
}

// CSRF helpers (for form POSTs; sessions required)
function csrf_token() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verify($token) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function require_login() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'authentication required']);
        exit;
    }
    return $_SESSION['user_id'];
}

function is_admin($pdo, $user_id = null) {
    if ($user_id === null) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $user_id = $_SESSION['user_id'] ?? null;
    }
    if (!$user_id) return false;
    $stmt = $pdo->prepare('SELECT is_admin FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $r = $stmt->fetch();
    return $r && intval($r['is_admin']) === 1;
}
?>