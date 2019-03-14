<?php
declare(strict_types=1);

namespace rash\map\values;

use rash\map\interfaces\CoordinatesInterface;
use rash\map\interfaces\MapInterface;
use rash\map\interfaces\MovementInterface;

class MovementStrategy implements MovementInterface
{
    /** @var array */
    private $matrix = [[-1, 0], [0, 1], [1, 0], [0, -1]];
    /** @var int */
    private $jumpHeight;
    /** @var int */
    private $dropHeight;

    /**
     * MovementStrategy constructor.
     * @param int $jumpHeight
     * @param int $dropHeight
     */
    public function __construct(int $jumpHeight = 1, int $dropHeight = 3)
    {
        $this->jumpHeight = $jumpHeight;
        $this->dropHeight = $dropHeight;
    }

    /**
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->matrix;
    }

    /**
     * @return int
     */
    public function getJumpHeight(): int
    {
        return $this->jumpHeight;
    }

    /**
     * @return int
     */
    public function getDropHeight(): int
    {
        return $this->dropHeight;
    }

    /**
     * @param MapInterface $map
     * @param CoordinatesInterface $from
     * @param CoordinatesInterface $to
     * @return bool
     */
    public function canWalk(MapInterface $map, CoordinatesInterface $from, CoordinatesInterface $to): bool
    {
        if (is_null($map->getTile($to)))
            return false;

        if (!$map->getTile($to)->isWalkable($this))
            return false;

        if ($map->getTile($to)->getHeight() > $map->getTile($from)->getHeight() + $this->getJumpHeight())
            return false;

        if ($map->getTile($to)->getHeight() < $map->getTile($from)->getHeight() - $this->getDropHeight())
            return false;

        return true;
    }
}