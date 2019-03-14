<?php
declare(strict_types=1);

namespace rash\map\interfaces;

interface RouteInterface
{
    /**
     * @param CoordinatesInterface $coordinates
     * @return RouteInterface
     */
    public function push(CoordinatesInterface $coordinates): RouteInterface;

    /**
     * @return RouteInterface
     */
    public function reverse(): RouteInterface;
}