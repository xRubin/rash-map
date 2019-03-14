<?php
declare(strict_types=1);

namespace rash\map\interfaces;

use rash\map\pathfinder\exceptions\PathfinderException;

interface PathfinderInterface
{
    /**
     * @return MapInterface
     */
    public function getMap(): MapInterface;

    /**
     * @param CoordinatesInterface $from
     * @param CoordinatesInterface $to
     * @param MovementInterface
     * @param CoordinatesInterface[] $obstacles
     * @return RouteInterface
     * @throws PathfinderException
     */
    public function findRoute2D(CoordinatesInterface $from, CoordinatesInterface $to, MovementInterface $critter, array $obstacles = []): RouteInterface;
}