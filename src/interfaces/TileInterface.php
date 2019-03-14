<?php
declare(strict_types=1);

namespace rash\map\interfaces;

interface TileInterface
{
    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @param MovementInterface $critter
     * @return bool
     */
    public function isWalkable(MovementInterface $critter): bool;

    /**
     * @return SpriteInterface
     */
    public function getSprite(): SpriteInterface;
}