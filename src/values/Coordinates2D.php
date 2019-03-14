<?php
declare(strict_types=1);

namespace rash\map\values;

class Coordinates2D implements \JsonSerializable
{
    /** @var int */
    private $x;
    /** @var int */
    private $y;

    /**
     * Coordinates2D constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return [
            'x' => $this->getX(),
            'y' => $this->getY(),
        ];
    }
}