<?php
declare(strict_types=1);

use rash\map\values\Coordinates2D;
use rash\map\interfaces\MapInterface;
use rash\map\interfaces\TileInterface;
use rash\map\pathfinder\WavePathfinder;
use rash\map\values\Route;
use rash\map\values\MovementStrategy;
use rash\map\pathfinder\exceptions\RouteNotFoundException;

class PathfinderTest extends \PHPUnit\Framework\TestCase
{
    public function testWavePathfinderFlat(): void
    {
        $pathfinder = new WavePathfinder($this->getFlatMap(8, 8));

        $route = $pathfinder->findRoute2D(
            new Coordinates2D(3,3),
            new Coordinates2D(4,7),
            new MovementStrategy()
        );

        $this->assertEquals(
            (new Route())
                ->push(new Coordinates2D(3,3))
                ->push(new Coordinates2D(3,4))
                ->push(new Coordinates2D(3,5))
                ->push(new Coordinates2D(3,6))
                ->push(new Coordinates2D(3,7))
                ->push(new Coordinates2D(4,7))
            , $route
        );
    }

    public function testWavePathfinderFlatWithObstacles(): void
    {
        $pathfinder = new WavePathfinder($this->getFlatMap(8, 8));

        $route = $pathfinder->findRoute2D(
            new Coordinates2D(3,3),
            new Coordinates2D(4,7),
            new MovementStrategy(),
            [
                new Coordinates2D(3, 5),
                new Coordinates2D(4, 5),
            ]
        );

        $this->assertEquals(
            (new Route())
                ->push(new Coordinates2D(3,3))
                ->push(new Coordinates2D(2,3))
                ->push(new Coordinates2D(2,4))
                ->push(new Coordinates2D(2,5))
                ->push(new Coordinates2D(2,6))
                ->push(new Coordinates2D(2,7))
                ->push(new Coordinates2D(3,7))
                ->push(new Coordinates2D(4,7))
            , $route
        );
    }

    public function testWavePathfinderRouteNotFound(): void
    {
        $pathfinder = new WavePathfinder($this->getFlatMap(8, 8));

        $this->expectException(RouteNotFoundException::class);
        $route = $pathfinder->findRoute2D(
            new Coordinates2D(3,3),
            new Coordinates2D(4,17),
            new MovementStrategy()
        );
    }

    protected function getFlatMap(int $width, int $length): MapInterface
    {
        $flatTile = $this->createMock(TileInterface::class);

        $flatTile->method('getHeight')
            ->willReturn(0);

        $flatTile->method('isWalkable')
            ->willReturn(true);

        /** @var TileInterface $flatTile */

        $map = $this->createMock(MapInterface::class);

        $map->method('getWidth')
            ->willReturn($width);

        $map->method('getLength')
            ->willReturn($length);

        $map->method('getTile')
            ->willReturn($flatTile);
        /** @var MapInterface $map */

        return $map;
    }
}
