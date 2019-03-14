<?php
declare(strict_types=1);

namespace rash\map\pathfinder;

use rash\map\interfaces\MapInterface;
use rash\map\interfaces\PathfinderInterface;

abstract class AbstractPathfinder implements PathfinderInterface
{
    /** @var MapInterface */
    private $map;

    /**
     * @param MapInterface $map
     */
    public function __construct(MapInterface $map)
    {
        $this->setMap($map);
    }

    /**
     * @return MapInterface
     */
    public function getMap(): MapInterface
    {
        return $this->map;
    }

    /**
     * @param MapInterface $map
     * @return AbstractPathfinder
     */
    public function setMap(MapInterface $map): PathfinderInterface
    {
        $this->map = $map;
        return $this;
    }
}