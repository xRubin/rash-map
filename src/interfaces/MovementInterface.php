<?php
declare(strict_types=1);

namespace rash\map\interfaces;

interface MovementInterface
{
    /**
     * @return array
     */
    public function getMatrix(): array;

    /**
     * @return int
     */
    public function getJumpHeight(): int;

    /**
     * @return int
     */
    public function getDropHeight(): int;

    /**
     * @param MapInterface $map
     * @param CoordinatesInterface $from
     * @param CoordinatesInterface $to
     * @return bool
     */
    public function canWalk(MapInterface $map, CoordinatesInterface $from, CoordinatesInterface $to): bool;
}