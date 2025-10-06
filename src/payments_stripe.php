<?php
// payments_stripe.php - sample Stripe PaymentIntent creation
// Composer and stripe-php required in production. This file shows example code and must be adapted with your keys.
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_json();
$input = json_input();
if (!$input || !isset($input['amount'])) { http_response_code(400); echo json_encode(['error'=>'amount required']); exit; }
$amount = intval($input['amount'] * 100); // convert to cents
// NOTE: Replace with Stripe SDK usage in production. Placeholder response:
echo json_encode(['ok'=>true,'message'=>'This is a demo. Integrate stripe-php and use Stripe\PaymentIntent::create.','amount_cents'=>$amount]);
?>