<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Processors;

use Esky\Infrastructure\WeatherDBI\Model\Weather;

interface DirectionScoreProcessorInterface
{
    public function process(Weather $weather, ?int $score = 0): int;
    public function appendNext(self $next): self;
}
