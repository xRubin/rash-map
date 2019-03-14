<?php
declare(strict_types=1);

namespace rash\map\interfaces;

use rash\map\pathfinder\exceptions\PathfinderException;
use rash\map\values\Coordinates2D;
use rash\map\values\Route;

interface PathfinderInterface
{
    /**
     * @param MapInterface $map
     * @return PathfinderInterface
     */
    public function setMap(MapInterface $map): PathfinderInterface;

    /**
     * @param Coordinates2D[] $obstacles
     * @return PathfinderInterface
     */
    public function setObstacles(array $obstacles): PathfinderInterface;

    /**
     * @param int $jumpHeight
     * @return PathfinderInterface
     */
    public function setJumpHeight(int $jumpHeight): PathfinderInterface;

    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @return RouteInterface
     * @throws PathfinderException
     */
    public function findRoute2D(Coordinates2D $from, Coordinates2D $to): RouteInterface;
}