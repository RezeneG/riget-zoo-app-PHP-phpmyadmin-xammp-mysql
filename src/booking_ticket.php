<?php
require_json();
$input = json_input();
if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}
/*
Expected JSON:
{
  "user_id": 1,
  "visit_date": "2025-10-15",
  "ticket_type": "adult",
  "quantity": 2
}
*/
global $pdo;
try {
    $pdo->beginTransaction();
    // Simple capacity check (ticket_capacity table)
    $stmt = $pdo->prepare('SELECT capacity, booked FROM ticket_capacity WHERE date = ? FOR UPDATE');
    $stmt->execute([$input['visit_date']]);
    $row = $stmt->fetch();
    if (!$row) {
        throw new Exception('No capacity row for date');
    }
    if ($row['booked'] + $input['quantity'] > $row['capacity']) {
        $pdo->rollBack();
        http_response_code(409);
        echo json_encode(['error' => 'Insufficient capacity']);
        exit;
    }
    // Insert booking
    $stmt = $pdo->prepare('INSERT INTO bookings (user_id, booking_type, total_amount, status) VALUES (?, ?, ?, ?)');
    $total = 10.00 * intval($input['quantity']); // example price
    $stmt->execute([$input['user_id'], 'zoo_ticket', $total, 'confirmed']);
    $booking_id = $pdo->lastInsertId();
    // Update capacity
    $stmt = $pdo->prepare('UPDATE ticket_capacity SET booked = booked + ? WHERE date = ?');
    $stmt->execute([$input['quantity'], $input['visit_date']]);
    // Insert zoo_tickets
    $stmt = $pdo->prepare('INSERT INTO zoo_tickets (booking_id, visit_date, ticket_type, quantity, price_each) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$booking_id, $input['visit_date'], $input['ticket_type'], $input['quantity'], 10.00]);
    $pdo->commit();
    echo json_encode(['ok' => true, 'booking_id' => $booking_id, 'total' => $total]);
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['error' => 'Booking failed', 'detail' => $e->getMessage()]);
}