<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI;

interface ClientInterface
{
    public function get(string $uri): string;
}
