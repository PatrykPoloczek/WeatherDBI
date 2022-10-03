<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Model;

use JMS\Serializer\Annotation as JMS;

class Day
{
    /**
     * @JMS\SerializedName("day")
     */
    private string $name = '';

    /**
     * @JMS\SerializedName("comment")
     */
    private string $description = '';

    /**
     * @JMS\SerializedName("min_temp")
     * @JMS\Type("Esky\Infrastructure\WeatherDBI\Model\Temperature")
     */
    private Temperature $minTemperature;

    /**
     * @JMS\SerializedName("max_temp")
     * @JMS\Type("Esky\Infrastructure\WeatherDBI\Model\Temperature")
     */
    private Temperature $maxTemperature;

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMinTemperature(): int
    {
        return $this->minTemperature->getC();
    }

    public function getMaxTemperature(): int
    {
        return $this->maxTemperature->getC();
    }
}
