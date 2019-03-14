<?php
declare(strict_types=1);

namespace rash\map\helpers;

use rash\map\interfaces\CoordinatesInterface;
use rash\map\interfaces\MapInterface;
use rash\map\values\Coordinates2D;
use rash\map\values\Coordinates3D;

class MapHelper
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

    /**
     * @param Coordinates3D $from
     * @param Coordinates3D $to
     * @return float
     */
    public static function distance3D(Coordinates3D $from, Coordinates3D $to): float
    {
        return sqrt(
            pow($from->getX() - $to->getX(), 2)
            + pow($from->getY() - $to->getY(), 2)
            + pow($from->getZ() - $to->getZ(), 2)
        );
    }

    /**
     * @param MapInterface $map
     * @param CoordinatesInterface $coordinates
     * @return bool
     */
    public static function containsCoordinates(MapInterface $map, CoordinatesInterface $coordinates): bool
    {
        return ($coordinates->getX() >=0)
            && ($coordinates->getY() >=0)
            && ($coordinates->getX() < $map->getWidth())
            && ($coordinates->getY() < $map->getLength())
            ;
    }
}