<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Processors;

use Esky\Infrastructure\WeatherDBI\Model\Weather;

class CurrentConditionsProcessor extends DirectionScoreProcessor implements DirectionScoreProcessorInterface
{
    public function process(Weather $weather, ?int $score = 0): int
    {
        $currentConditions = $weather->getCurrent();
        $desiredRainfall = 0 === (int) str_replace('%', '', $currentConditions->getRainfall());
        $desiredWind = 0 === $currentConditions->getWind()->getSpeed();
        $humidity = $currentConditions->getHumidity();
        $desiredHumidity = 40 <= $humidity && 70 >= $humidity;

        $bonus = 0;

        switch ((int) $desiredRainfall . (int) $desiredWind . (int) $desiredHumidity) {
            case '100':
                $bonus = $score * 0.1;
                break;
            case '101':
                $bonus = $score * 0.1;
                break;
            case '110':
                $bonus = $score * 0.2;
                break;
            case '111':
                $bonus = $score * 0.3;
                break;
            default:
                break;
        }

        $score += (int) $bonus;

        return !$this->next
            ? $this->yieldScore($score)
            : $this->next->process($weather, $score)
        ;
    }
}
