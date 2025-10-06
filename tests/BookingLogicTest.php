<?php
use PHPUnit\Framework\TestCase;

final class BookingLogicTest extends TestCase {
    public function testRoomNightsCalculation() {
        $start = new DateTime('2025-10-10');
        $end = new DateTime('2025-10-13');
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);
        $nights = 0;
        foreach ($period as $d) { $nights++; }
        $this->assertEquals(3, $nights);
    }
    public function testLoyaltyPointsAward() {
        $amount = 199.99;
        $points = floor($amount / 10);
        $this->assertEquals(19, $points);
    }
}
