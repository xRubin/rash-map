<?php
declare(strict_types=1);

namespace rash\map\helpers;

use rash\map\interfaces\CoordinatesInterface;

class DistanceHelper
{
    /**
     * @param CoordinatesInterface $from
     * @param CoordinatesInterface $to
     * @return float
     */
    public static function distance2D(CoordinatesInterface $from, CoordinatesInterface $to): float
    {
        return sqrt(
            pow($from->getX() - $to->getX(), 2)
            + pow($from->getY() - $to->getY(), 2)
        );
    }
}