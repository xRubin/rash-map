<?php
declare(strict_types=1);

use rash\map\values\Coordinates2D;
use rash\map\interfaces\MapInterface;
use rash\map\interfaces\TileInterface;
use rash\map\pathfinder\WavePathfinder;

class PathfinderTest extends \PHPUnit\Framework\TestCase
{
    public function testWavePathfinderFlat(): void
    {
        $flatTile = $this->createMock(TileInterface::class);

        $flatTile->method('getHeight')
            ->willReturn(0);

        $flatTile->method('isWalkable')
            ->willReturn(true);

        $map = $this->createMock(MapInterface::class);

        $map->method('getWidth')
            ->willReturn(8);

        $map->method('getLength')
            ->willReturn(8);

        $map->method('getTile')
            ->willReturn($flatTile);

        /** @var MapInterface $map */

        $pathfinder = new WavePathfinder($map);
        $pathfinder->setJumpHeight(1);

        $route = $pathfinder->findRoute2D(new Coordinates2D(3,3), new Coordinates2D(4,7));

        $this->assertEquals(
            (new \rash\map\values\Route())
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
        $flatTile = $this->createMock(TileInterface::class);

        $flatTile->method('getHeight')
            ->willReturn(0);

        $flatTile->method('isWalkable')
            ->willReturn(true);

        $map = $this->createMock(MapInterface::class);

        $map->method('getWidth')
            ->willReturn(8);

        $map->method('getLength')
            ->willReturn(8);

        $map->method('getTile')
            ->willReturn($flatTile);

        /** @var MapInterface $map */

        $pathfinder = new WavePathfinder($map);
        $pathfinder->setJumpHeight(1);
        $pathfinder->setObstacles([
            new Coordinates2D(3, 5),
            new Coordinates2D(4, 5),
        ]);

        $route = $pathfinder->findRoute2D(new Coordinates2D(3,3), new Coordinates2D(4,7));

        $this->assertEquals(
            (new \rash\map\values\Route())
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
}
