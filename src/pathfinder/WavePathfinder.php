<?php
declare(strict_types=1);

namespace rash\map\pathfinder;

use rash\map\interfaces\MovementInterface;
use rash\map\interfaces\RouteInterface;
use rash\map\pathfinder\exceptions\RouteNotFoundException;
use rash\map\values\Coordinates2D;
use rash\map\values\Route;

class WavePathfinder extends AbstractPathfinder
{
    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @param MovementInterface $movement
     * @param Coordinates2D[] $obstacles
     * @return Route
     */
    public function findRoute2D(Coordinates2D $from, Coordinates2D $to, MovementInterface $movement, array $obstacles = []): RouteInterface
    {
        $width = $this->getMap()->getWidth();
        $length = $this->getMap()->getLength();
        $weights = [];
        $weights[$to->getX()][$to->getY()] = 0;
        for ($step = 0; $step < $width * $length; $step++) {
            for ($x = 0; $x < $width; $x++) {
                for ($y = 0; $y < $length; $y++) {
                    if (@$weights[$x][$y] !== $step)
                        continue;

                    foreach ($movement->getMatrix() as $offsets) {
                        list($offsetX, $offsetY) = $offsets;
                        if (!$this->mapContainsCoordinates(new Coordinates2D($x + $offsetX, $y + $offsetY)))
                            continue;

                        if (!is_null(@$weights[$x + $offsetX][$y + $offsetY]))
                            continue;

                        if (!$this->isWalkable(new Coordinates2D($x, $y), new Coordinates2D($x + $offsetX, $y + $offsetY), $movement, $obstacles))
                            continue;

                        $weights[$x + $offsetX][$y + $offsetY] = $step + 1;

                        if ($from->equalTo(new Coordinates2D($x + $offsetX, $y + $offsetY)))
                            return $this->buildRoute($weights, $from, $movement);

                    }

                }
            }
        }

        throw new RouteNotFoundException();
    }

    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @param MovementInterface $movement
     * @param Coordinates2D[] $obstacles
     * @return bool
     */
    protected function isWalkable(Coordinates2D $from, Coordinates2D $to, MovementInterface $movement, array $obstacles = []): bool
    {
        if (!parent::isWalkable($from, $to, $movement))
            return false;

        foreach ($obstacles as $coordinate) {
            if ($coordinate->equalTo($to))
                return false;
        }

        return true;
    }

    /**
     * @param array $weights
     * @param Coordinates2D $from
     * @param MovementInterface $movement
     * @return Route
     */
    private function buildRoute(array $weights, Coordinates2D $from, MovementInterface $movement): RouteInterface
    {
        $route = new Route();
        for ($i = $weights[$from->getX()][$from->getY()]; $i >= 0; $i--) {
            foreach ($movement->getMatrix() as $offsets) {
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