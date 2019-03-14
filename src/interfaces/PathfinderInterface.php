<?php
declare(strict_types=1);

namespace rash\map\interfaces;

use rash\map\pathfinder\exceptions\PathfinderException;
use rash\map\values\Coordinates2D;

interface PathfinderInterface
{
    /**
     * @return MapInterface
     */
    public function getMap(): MapInterface;

    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @param MovementInterface
     * @param Coordinates2D[] $obstacles
     * @return RouteInterface
     * @throws PathfinderException
     */
    public function findRoute2D(Coordinates2D $from, Coordinates2D $to, MovementInterface $critter, array $obstacles = []): RouteInterface;
}