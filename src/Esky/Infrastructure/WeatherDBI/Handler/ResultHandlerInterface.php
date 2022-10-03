<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Handler;

use Esky\Application\Model\DTO\Result;
use Esky\Infrastructure\WeatherDBI\Model\Weather;

interface ResultHandlerInterface
{
    public function handle(array $weathers): Result;
}
