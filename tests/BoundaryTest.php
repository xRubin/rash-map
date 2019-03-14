<?php
declare(strict_types=1);

use rash\map\values\Coordinates2D;
use rash\map\interfaces\MapInterface;
use rash\map\interfaces\TileInterface;
use rash\map\helpers\BoundaryHelper;

class BoundaryTest extends \PHPUnit\Framework\TestCase
{
    public function testBoundary(): void
    {
        $map = $this->getFlatMap(8, 8);

        $this->assertTrue(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(0, 0)));
        $this->assertTrue(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(3, 0)));
        $this->assertTrue(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(4, 6)));
        $this->assertTrue(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(7, 7)));

        $this->assertFalse(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(-1, 4)));
        $this->assertFalse(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(3, -2)));
        $this->assertFalse(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(8, 4)));
        $this->assertFalse(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(4, 8)));
        $this->assertFalse(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(8, 8)));
        $this->assertFalse(BoundaryHelper::mapContainsCoordinates($map, new Coordinates2D(128, 18)));
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