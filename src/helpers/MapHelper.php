<?php
declare(strict_types=1);

namespace rash\map\helpers;

use rash\map\values\Coordinates2D;
use rash\map\values\Coordinates3D;

class MapHelper
{
    public static function distance2D(Coordinates2D $from, Coordinates2D $to): float
    {
        return sqrt(
            pow($from->getX() - $to->getX(), 2)
            + pow($from->getY() - $to->getY(), 2)
        );
    }

    public static function distance3D(Coordinates3D $from, Coordinates3D $to): float
    {
        return sqrt(
            pow($from->getX() - $to->getX(), 2)
            + pow($from->getY() - $to->getY(), 2)
            + pow($from->getZ() - $to->getZ(), 2)
        );
    }
}