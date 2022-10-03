<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Handler;

use Esky\Application\Model\DTO\Result;
use Esky\Application\Model\DTO\Direction;
use Esky\Infrastructure\WeatherDBI\Builder\DirectionBuilderInterface;
use Esky\Infrastructure\WeatherDBI\Processors\DirectionScoreProcessorInterface;

class DirectionResultHandler implements ResultHandlerInterface
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

    public function handle(array $weathers): Result
    {
        $result = new Result();
        $directions = [];

        foreach ($weathers as $weather) {
            $score = $this->scoreProcessor->process($weather);
            $directions[] = $this->directionBuilder->build(
                $score,
                $weather->getRegion(),
                $weather->getCurrent()->getTemperature(),
                $weather->getCurrent()->getHumidity(),
                $weather->getCurrent()->getWind()->getSpeed(),
                $weather->getCurrent()->getRainfall()
            );
        }

        usort($directions, function ($a, $b) {
            return $a->score < $b->score;
        });

        $result->bestDirection = $directions[0];
        $result->directions = $directions;

        return $result;
    }
}
