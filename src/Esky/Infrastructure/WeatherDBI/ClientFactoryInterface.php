<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI;

interface ClientFactoryInterface
{
    public function create(): ClientInterface;
}
