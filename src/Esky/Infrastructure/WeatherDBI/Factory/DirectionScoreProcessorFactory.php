<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Factory;

use Esky\Infrastructure\WeatherDBI\Processors\CurrentConditionsProcessor;
use Esky\Infrastructure\WeatherDBI\Processors\TemperatureProcessor;
use Esky\Infrastructure\WeatherDBI\Processors\DirectionScoreProcessorInterface;
use Esky\Infrastructure\WeatherDBI\Processors\WeatherDescriptionProcessor;

class DirectionScoreProcessorFactory
{
    public function create(): DirectionScoreProcessorInterface
    {
        $mainProcessor = new TemperatureProcessor();

        $mainProcessor
            ->appendNext(new WeatherDescriptionProcessor())
            ->appendNext(new CurrentConditionsProcessor())
        ;

        return $mainProcessor;
    }
}
