<?php
use PHPUnit\Framework\TestCase;

final class BookingTest extends TestCase {
    public function testPriceCalculation() {
        $price = 75.00;
        $nights = 3;
        $total = $price * $nights;
        $this->assertEquals(225.00, $total);
    }
    public function testPointsAward() {
        $amount = 250.0;
        $points = floor($amount / 10);
        $this->assertEquals(25, $points);
    }
}
