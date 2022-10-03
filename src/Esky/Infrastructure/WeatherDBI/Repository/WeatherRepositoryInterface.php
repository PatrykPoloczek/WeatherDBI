<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Repository;

use Esky\Infrastructure\WeatherDBI\Model\Weather;

interface WeatherRepositoryInterface
{
    public function getWeatherByDirection(string $destination): Weather;
}
