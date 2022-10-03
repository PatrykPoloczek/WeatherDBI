<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Processors;

use Esky\Infrastructure\WeatherDBI\Model\Weather;

abstract class DirectionScoreProcessor implements DirectionScoreProcessorInterface
{
    protected const MAX_SCORE = 416;

    protected ?DirectionScoreProcessorInterface $next = null;

    public function appendNext(DirectionScoreProcessorInterface $next): DirectionScoreProcessorInterface
    {
        if (null !== $this->next) {
            return $this->next->appendNext($next);
        }

        $this->next = $next;

        return $this;
    }

    public function process(Weather $weather, ?int $score = 0): int
    {
        if (!$this->next) {
            return $this->yieldScore($score);
        }

        return $this->next->process($weather);
    }

    protected function yieldScore(?int $score = 0): int
    {
        return self::MAX_SCORE <= $score
            ? self::MAX_SCORE
            : $score
        ;
    }
}
