<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Factory;

use Esky\Infrastructure\WeatherDBI\Builder\DirectionBuilderInterface;
use Esky\Infrastructure\WeatherDBI\ResultHandlerFactoryInterface;
use Esky\Infrastructure\WeatherDBI\Handler\DirectionResultHandler;
use Esky\Infrastructure\WeatherDBI\Handler\ResultHandlerInterface;
use Esky\Infrastructure\WeatherDBI\Processors\DirectionScoreProcessorInterface;

class DirectionResultHandlerFactory implements ResultHandlerFactoryInterface
{
    private DirectionScoreProcessorInterface $scoreProcessor;
    private DirectionBuilderInterface $directionBuilder;

    public function __construct(
        DirectionScoreProcessorInterface $scoreProcessor,
        DirectionBuilderInterface $directionBuilder
    ) {
        $this->scoreProcessor = $scoreProcessor;
        $this->directionBuilder = $directionBuilder;
    }

    public function create(): ResultHandlerInterface
    {
        return new DirectionResultHandler(
            $this->scoreProcessor,
            $this->directionBuilder
        );
    }
}
