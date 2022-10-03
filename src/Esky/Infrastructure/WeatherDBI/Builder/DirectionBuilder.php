<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Builder;

use Esky\Application\Model\DTO\Direction;

class DirectionBuilder implements DirectionBuilderInterface
{
    public function build(
        int $score,
        string $region,
        int $temperature,
        string $humidity,
        int $wind,
        string $rainfall
    ): Direction {
        $direction = new Direction();

        $direction->score = $score;
        $direction->region = $region;
        $direction->temperature = $temperature;
        $direction->humidity = (int) str_replace('%', '', $humidity);
        $direction->wind = $wind;
        $direction->rainfall = (int) str_replace('%', '', $rainfall);

        return $direction;
    }
}
