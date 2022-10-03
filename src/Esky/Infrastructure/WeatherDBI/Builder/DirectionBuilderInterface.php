<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Builder;

use Esky\Application\Model\DTO\Direction;

interface DirectionBuilderInterface
{
    public function build(
        int $score,
        string $region,
        int $temperature,
        string $humidity,
        int $wind,
        string $rainfall
    ): Direction;
}
