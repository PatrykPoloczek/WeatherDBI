<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Model;

use JMS\Serializer\Annotation as JMS;

class Weather
{
    private string $region = '';

    /**
     * @JMS\SerializedName("currentConditions")
     * @JMS\Type("Esky\Infrastructure\WeatherDBI\Model\Current")
     */
    private ?Current $current = null;

    /**
     * @JMS\SerializedName("next_days")
     * @JMS\Type("array<Esky\Infrastructure\WeatherDBI\Model\Day>")
     */
    private array $nextDays = [];

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getCurrent(): Current
    {
        return $this->current;
    }

    /**
     * @return Day[]
     */
    public function getNextDays(): array
    {
        return $this->nextDays;
    }
}
