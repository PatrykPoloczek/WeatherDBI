<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI;

use Esky\Infrastructure\WeatherDBI\Handler\ResultHandlerInterface;

interface ResultHandlerFactoryInterface
{
    public function create(): ResultHandlerInterface;
}
