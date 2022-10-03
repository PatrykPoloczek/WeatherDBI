<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Processors;

use Esky\Infrastructure\WeatherDBI\Model\Weather;

class TemperatureProcessor extends DirectionScoreProcessor implements DirectionScoreProcessorInterface
{
    public function process(Weather $weather, ?int $score = 0): int
    {
        foreach ($weather->getNextDays() as $day) {
            $temperature = $day->getMaxTemperature();

            if ($temperature >= 15 && $temperature <= 25) {
                $score += 10;

                continue;
            }

            if ($temperature >= 26 && $temperature <= 32) {
                $score += 20;
            }
        }

        return !$this->next
            ? $score
            : $this->next->process($weather, $score)
        ;
    }
}
