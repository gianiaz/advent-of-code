<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day4;

class BeginShift extends AbstractTimestamp
{
    /** @var int */
    private $guardId;

    /**
     * BeginShift constructor.
     */
    public function __construct(string $time, string $guard)
    {
        parent::__construct($time);
        $this->guardId = (int) $guard;
    }

    public function getGuardId(): int
    {
        return $this->guardId;
    }
}
