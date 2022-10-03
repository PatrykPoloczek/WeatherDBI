<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Model;

use JMS\Serializer\Annotation as JMS;

class Wind
{
    /**
     * @JMS\SerializedName("km")
     */
    private int $speed = 0;

    public function getSpeed(): int
    {
        return $this->speed;
    }
}
