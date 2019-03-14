<?php
declare(strict_types=1);

namespace rash\map\values;

class Coordinates3D extends Coordinates2D
{
    /** @var int */
    private $z;

    /**
     * Coordinates3D constructor.
     * @param int $x
     * @param int $y
     * @param int $z
     */
    public function __construct(int $x, int $y, int $z)
    {
        $this->z = $z;
        parent::__construct($x, $y);
    }

    /**
     * @return int
     */
    public function getZ(): int
    {
        return $this->z;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return [
            'x' => $this->getX(),
            'y' => $this->getY(),
            'z' => $this->getZ(),
        ];
    }
}