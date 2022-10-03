<?php

declare(strict_types=1);

namespace Features\Application;

use Coduo\PHPMatcher\PHPMatcher;
use Coduo\PHPMatcher\Matcher;
use Coduo\PHPMatcher\Factory\MatcherFactory;

trait DataMatcherTrait
{
    /**
     * @var PHPMatcher
     */
    private $matcher;

    /**
     * @param mixed $excepted
     * @param mixed $value
     */
    public function match($excepted, $value): void
    {
        if (!$this->getMatcher()->match($value, $excepted)) {
            throw new \RuntimeException($this->getMatcher()->error());
        }
    }

    public function matchTextLine(string $excepted, string $value): void
    {
        $excepted = explode(PHP_EOL, trim($excepted));
        $value = explode(PHP_EOL, trim($value));

        foreach ($excepted as $index => $row) {
            $excepted[$index] = trim($row);
        }

        foreach ($value as $index => $row) {
            $value[$index] = trim($row);
        }

        $this->match($excepted, $value);
    }

    private function getMatcher(): PHPMatcher
    {
        if (is_null($this->matcher)) {
            $this->matcher = new PHPMatcher();
        }

        return $this->matcher;
    }
}
