<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_json();
$input = json_input();
// expected: user_id, room_id, start_date, end_date
if (!$input || !isset($input['user_id']) || !isset($input['room_id']) || !isset($input['start_date']) || !isset($input['end_date'])) {
    http_response_code(400); echo json_encode(['error'=>'missing fields']); exit;
}
try {
    $pdo->beginTransaction();
    // check room exists
    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE id = ? FOR UPDATE');
    $stmt->execute([$input['room_id']]);
    $room = $stmt->fetch();
    if (!$room) throw new Exception('Room not found');
    // iterate dates and ensure availability
    $start = new DateTime($input['start_date']);
    $end = new DateTime($input['end_date']);
    if ($end <= $start) throw new Exception('Invalid date range');
    $period = new DatePeriod($start, new DateInterval('P1D'), $end);
    foreach ($period as $dt) {
        $d = $dt->format('Y-m-d');
        // attempt to insert inventory row (will fail if unique constraint exists and booked)
        $stmt = $pdo->prepare('SELECT status FROM room_inventory WHERE room_id = ? AND date = ? FOR UPDATE');
        $stmt->execute([$input['room_id'], $d]);
        $row = $stmt->fetch();
        if ($row && $row['status'] != 'available') {
            $pdo->rollBack(); http_response_code(409); echo json_encode(['error'=>'room not available on ' . $d]); exit;
        }
    }
    // create booking
    $nights = 0
    ;$p = $pdo->prepare('INSERT INTO bookings (user_id, booking_type, total_amount, status) VALUES (?, ?, ?, ?)');
    // naive price calculation
    $days = 0
    ;foreach ($period as $dt) { $days++; }
    $total = $room['price_standard'] * $days;
    $p->execute([$input['user_id'], 'hotel', $total, 'confirmed']);
    $booking_id = $pdo->lastInsertId();
    // mark inventory as booked
    foreach ($period as $dt) {
        $d = $dt->format('Y-m-d');
        $ins = $pdo->prepare('INSERT INTO room_inventory (room_id, date, status, booking_id) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE status=VALUES(status), booking_id=VALUES(booking_id)');
        $ins->execute([$input['room_id'], $d, 'booked', $booking_id]);
    }
    $pdo->commit();
    echo json_encode(['ok'=>true,'booking_id'=>$booking_id,'total'=>$total]);
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500); echo json_encode(['error'=>'booking failed','detail'=>$e->getMessage()]);
}