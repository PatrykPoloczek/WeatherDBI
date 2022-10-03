<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Model;

use JMS\Serializer\Annotation as JMS;

class Current
{
    /**
     * @JMS\SerializedName("dayhour")
     */
    private string $dayHour = '';

    /**
     * @JMS\SerializedName("comment")
     */
    private string $description = '';

    /**
     * @JMS\SerializedName("temp")
     * @JMS\Type("Esky\Infrastructure\WeatherDBI\Model\Temperature")
     */
    private Temperature $temperature;

    /**
     * @JMS\SerializedName("precip")
     */
    private string $rainfall = '';

    /**
     * @JMS\SerializedName("humidity")
     */
    private string $humidity = '';

    /**
     * @JMS\SerializedName("wind")
     * @JMS\Type("Esky\Infrastructure\WeatherDBI\Model\Wind")
     */
    private Wind $wind;

    public function geDayHour(): string
    {
        return $this->dayHour;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTemperature(): int
    {
        return $this->temperature->getC();
    }

    public function getRainfall(): string
    {
        return $this->rainfall;
    }

    public function getHumidity(): string
    {
        return $this->humidity;
    }

    public function getWind(): Wind
    {
        return $this->wind;
    }
}
