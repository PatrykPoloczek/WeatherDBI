<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI;

use Esky\Infrastructure\WeatherDBI\Processors\DirectionScoreProcessorInterface;

interface ScoreProcessorFactoryInterface
{
    public function create(): DirectionScoreProcessorInterface;
}
