<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Model;

class Temperature
{
    private int $c = 0;
    private int $f = 0;

    public function getC(): int
    {
        return $this->c;
    }

    public function getF(): int
    {
        return $this->f;
    }
}
