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
}