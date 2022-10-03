<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Processors;

use Esky\Infrastructure\WeatherDBI\Model\Weather;

class WeatherDescriptionProcessor extends DirectionScoreProcessor implements DirectionScoreProcessorInterface
{
    private const SUNNY_WEATHER = 'Sunny';
    private const MOSTLY_SUNNY_WEATHER = 'Mostly sunny';

    public function process(Weather $weather, ?int $score = 0): int
    {
        foreach ($weather->getNextDays() as $day) {
            $description = $day->getDescription();

            if (self::SUNNY_WEATHER === $description) {
                $score += 10;

                continue;
            }

            if (self::MOSTLY_SUNNY_WEATHER === $description) {
                $score += 20;
            }
        }

        return !$this->next
            ? $score
            : $this->next->process($weather, $score)
        ;
    }
}
