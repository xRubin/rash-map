<?php
declare(strict_types=1);

namespace rash\map\pathfinder;

use rash\map\interfaces\CoordinatesInterface;
use rash\map\interfaces\MapInterface;
use rash\map\interfaces\MovementInterface;
use rash\map\interfaces\PathfinderInterface;
use rash\map\values\Coordinates2D;

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

    /**
     * @param CoordinatesInterface $coordinates
     * @return bool
     */
    protected function mapContainsCoordinates(CoordinatesInterface $coordinates): bool
    {
        return ($coordinates->getX() >=0)
            && ($coordinates->getY() >=0)
            && ($coordinates->getX() < $this->getMap()->getWidth())
            && ($coordinates->getY() < $this->getMap()->getLength())
            ;
    }

    /**
     * @param Coordinates2D $from
     * @param Coordinates2D $to
     * @param MovementInterface $critter
     * @return bool
     */
    protected function isWalkable(Coordinates2D $from, Coordinates2D $to, MovementInterface $critter): bool
    {
        if (is_null($this->getMap()->getTile($to)))
            return false;

        if (!$this->getMap()->getTile($to)->isWalkable($critter))
            return false;

        if ($this->getMap()->getTile($to)->getHeight() > $this->getMap()->getTile($from)->getHeight() + $critter->getJumpHeight())
            return false;

        if ($this->getMap()->getTile($to)->getHeight() < $this->getMap()->getTile($from)->getHeight() - $critter->getDropHeight())
            return false;

        return true;
    }
}