<?php
declare(strict_types=1);

namespace rash\map\interfaces;

use rash\map\values\Coordinates2D;

interface MapInterface
{
    /**
     * @param Coordinates2D $coordinates
     * @return null|TileInterface
     */
    public function getTile(Coordinates2D $coordinates): ?TileInterface;

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @return int
     */
    public function getLength(): int;
}