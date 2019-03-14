<?php
declare(strict_types=1);

use rash\map\values\Coordinates2D;
use rash\map\interfaces\MapInterface;
use rash\map\interfaces\TileInterface;
use rash\map\pathfinder\WavePathfinder;
use rash\map\values\Route;
use rash\map\values\MovementStrategy;

class PathfinderTest extends \PHPUnit\Framework\TestCase
{
    public function testWavePathfinderFlat(): void
    {
        $pathfinder = new WavePathfinder($this->getFlatMap());

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
        $pathfinder = new WavePathfinder($this->getFlatMap());

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

    protected function getFlatMap(): MapInterface
    {
        $flatTile = $this->createMock(TileInterface::class);

        $flatTile->method('getHeight')
            ->willReturn(0);

        $flatTile->method('isWalkable')
            ->willReturn(true);

        /** @var TileInterface $flatTile */

        $map = $this->createMock(MapInterface::class);

        $map->method('getWidth')
            ->willReturn(8);

        $map->method('getLength')
            ->willReturn(8);

        $map->method('getTile')
            ->willReturn($flatTile);
        /** @var MapInterface $map */

        return $map;
    }
}
