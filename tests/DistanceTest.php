<?php
declare(strict_types=1);

use rash\map\values\Coordinates2D;
use rash\map\helpers\MapHelper;

class DistanceTest extends \PHPUnit\Framework\TestCase
{
    public function testDistance2D(): void
    {
        $from = new Coordinates2D(2, 3);
        $to = new Coordinates2D(5, 7);
        $this->assertEquals(5, MapHelper::distance2D($from, $to), 'Wrong distance', 0.01);
    }
}