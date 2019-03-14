<?php
declare(strict_types=1);

namespace rash\map\helpers;

use rash\map\values\Coordinates2D;

class DistanceHelper
{
    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @return float
     */
    public static function distance2D(Coordinates2D $from, Coordinates2D $to): float
    {
        return sqrt(
            pow($from->getX() - $to->getX(), 2)
            + pow($from->getY() - $to->getY(), 2)
        );
    }
}