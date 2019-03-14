<?php
declare(strict_types=1);

namespace rash\map\pathfinder;

use rash\map\helpers\MapHelper;
use rash\map\interfaces\MapInterface;
use rash\map\interfaces\PathfinderInterface;
use rash\map\interfaces\RouteInterface;
use rash\map\pathfinder\exceptions\RouteNotFoundException;
use rash\map\values\Coordinates2D;
use rash\map\values\Route;

class WavePathfinder implements PathfinderInterface
{
    /** @var MapInterface */
    private $map;
    /** @var Coordinates2D[] */
    private $obstacles = [];
    /** @var int */
    private $jumpHeight = 0;

    private const MOVE_MATRIX = [[-1, 0], [0, 1], [1, 0], [0, -1]];

    /**
     * @param MapInterface $map
     */
    public function __construct(MapInterface $map)
    {
        $this->setMap($map);
    }


    /**
     * @param MapInterface $map
     * @return WavePathfinder
     */
    public function setMap(MapInterface $map): PathfinderInterface
    {
        $this->map = $map;
        return $this;
    }

    /**
     * @return Coordinates2D[]
     */
    public function getObstacles(): array
    {
        return $this->obstacles;
    }

    /**
     * @param Coordinates2D[] $obstacles
     * @return WavePathfinder
     */
    public function setObstacles(array $obstacles): PathfinderInterface
    {
        $this->obstacles = $obstacles;
        return $this;
    }

    /**
     * @return int
     */
    public function getJumpHeight(): int
    {
        return $this->jumpHeight;
    }

    /**
     * @param int $jumpHeight
     * @return WavePathfinder
     */
    public function setJumpHeight(int $jumpHeight): PathfinderInterface
    {
        $this->jumpHeight = $jumpHeight;
        return $this;
    }

    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @param int $heightJump
     * @return Route
     */
    public function findRoute2D(Coordinates2D $from, Coordinates2D $to, int $heightJump = 0): RouteInterface
    {
        $weights = [];
        $weights[$to->getX()][$to->getY()] = 0;
        for ($step = 0; $step < $this->map->getWidth() * $this->map->getLength(); $step++) {
            for ($x = 0; $x < $this->map->getWidth(); $x++) {
                for ($y = 0; $y < $this->map->getLength(); $y++) {
                    if (@$weights[$x][$y] === $step) {

                        foreach (self::MOVE_MATRIX as $offsets) {
                            list($offsetX, $offsetY) = $offsets;
                            if (!MapHelper::containsCoordinates($this->map, new Coordinates2D($x + $offsetX, $y + $offsetY)))
                                continue;

                            if (!is_null(@$weights[$x + $offsetX][$y + $offsetY]))
                                continue;

                            if (!$this->isWalkable(new Coordinates2D($x, $y), new Coordinates2D($x + $offsetX, $y + $offsetY)))
                                continue;

                            $weights[$x + $offsetX][$y + $offsetY] = $step + 1;

                            if ($from->equalTo(new Coordinates2D($x + $offsetX, $y + $offsetY)))
                                return $this->buildRoute($weights, $from);

                        }
                    }
                }
            }
        }

        throw new RouteNotFoundException();
    }

    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @return bool
     */
    private function isWalkable(Coordinates2D $from, Coordinates2D $to): bool
    {
        foreach ($this->getObstacles() as $coordinate) {
            if ($coordinate->equalTo($to))
                return false;
        }

        if (!$this->map->getTile($to)->isWalkable())
            return false;

        if ($this->map->getTile($to)->getHeight() > $this->map->getTile($from)->getHeight() + $this->getJumpHeight())
            return false;

        return true;
    }

    /**
     * @param array $weights
     * @param Coordinates2D $from
     * @return Route
     */
    private function buildRoute(array $weights, Coordinates2D $from): RouteInterface
    {
        $route = new Route();
        for ($i = $weights[$from->getX()][$from->getY()]; $i >= 0; $i--) {
            foreach (self::MOVE_MATRIX as $offsets) {
                list($offsetX, $offsetY) = $offsets;
                if (@$weights[$from->getX() + $offsetX][$from->getY() + $offsetY] === $i) {
                    $route->push($from);
                    $from = new Coordinates2D($from->getX() + $offsetX, $from->getY() + $offsetY);
                    break;
                }
            }
        }

        return $route->push($from);
    }
}