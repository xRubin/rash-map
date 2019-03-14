<?php
declare(strict_types=1);

namespace rash\map\interfaces;

interface MapInterface
{
    /**
     * @param CoordinatesInterface $coordinates
     * @return null|TileInterface
     */
    public function getTile(CoordinatesInterface $coordinates): ?TileInterface;

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @return int
     */
    public function getLength(): int;

    /**
     * @param CoordinatesInterface $from
     * @param CoordinatesInterface $to
     * @param MovementInterface $critter
     * @return bool
     */
    public function isWalkable(CoordinatesInterface $from, CoordinatesInterface $to, MovementInterface $critter): bool;
}