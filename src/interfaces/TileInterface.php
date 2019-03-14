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
     * @return bool
     */
    public function isWalkable(): bool;

    /**
     * @return SpriteInterface
     */
    public function getSprite(): SpriteInterface;
}