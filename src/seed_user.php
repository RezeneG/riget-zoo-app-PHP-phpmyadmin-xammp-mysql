<?php
// seed_user.php - run via CLI: php seed_user.php
require_once __DIR__ . '/db.php';
$email = 'demo@example.com';
$password = 'Password123!'; // change as desired
$full = 'Demo User';
$phone = '+441234567890';
$marketing = 1;
$hash = password_hash($password, PASSWORD_DEFAULT);
try {
    $stmt = $pdo->prepare('INSERT INTO users (email, password_hash, full_name, phone, marketing_consent, role, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$email, $hash, $full, $phone, $marketing, 'user', 1]);
    echo "Inserted user with id: " . $pdo->lastInsertId() . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
?>