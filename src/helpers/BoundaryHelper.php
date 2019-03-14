<?php
declare(strict_types=1);

namespace rash\map\helpers;

use rash\map\interfaces\CoordinatesInterface;
use rash\map\interfaces\MapInterface;

class BoundaryHelper
{
    /**
     * @param MapInterface $map
     * @param CoordinatesInterface $coordinates
     * @return bool
     */
    public static function mapContainsCoordinates(MapInterface $map, CoordinatesInterface $coordinates): bool
    {
        return ($coordinates->getX() >= 0)
            && ($coordinates->getY() >= 0)
            && ($coordinates->getX() < $map->getWidth())
            && ($coordinates->getY() < $map->getLength());
    }
}