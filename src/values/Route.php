<?php
declare(strict_types=1);

namespace rash\map\values;

use rash\map\interfaces\CoordinatesInterface;
use rash\map\interfaces\RouteInterface;

class Route implements RouteInterface
{
    /** @var CoordinatesInterface[] */
    private $coordinates = [];

    /**
     * @param CoordinatesInterface $coordinates
     * @return Route
     */
    public function push(CoordinatesInterface $coordinates): RouteInterface
    {
        $this->coordinates[] = $coordinates;
        return $this;
    }

    /**
     * @return Route
     */
    public function reverse(): RouteInterface
    {
        $this->coordinates = array_reverse($this->coordinates);
        return $this;
    }

    /**
     * @param int $offset
     * @param int|null $length
     * @return RouteInterface
     */
    public function slice(int $offset, int $length = null): RouteInterface
    {
        $this->coordinates = array_slice($this->coordinates, $offset, $length);
        return $this;
    }

    /**
     * @return int
     */
    public function countSteps(): int
    {
        return count($this->coordinates);
    }

    /**
     * @return \Iterator
     */
    public function getIterator(): \Iterator
    {
        return new \ArrayIterator($this->coordinates);
    }
}