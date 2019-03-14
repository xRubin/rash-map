<?php
declare(strict_types=1);

namespace rash\map\interfaces;

interface CoordinatesInterface
{
    /**
     * @param CoordinatesInterface $coordinates
     * @return bool
     */
    public function equalTo(CoordinatesInterface $coordinates): bool;
}