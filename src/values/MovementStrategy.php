<?php
declare(strict_types=1);

namespace rash\map\values;

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
}