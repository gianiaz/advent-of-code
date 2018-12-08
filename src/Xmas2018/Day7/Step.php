<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day7;

class Step
{
    /** @var string */
    private $name;

    /** @var Step[] */
    private $dependsOn = [];

    /** @var bool */
    private $complete = false;

    private $obsolete = false;

    /**
     * Step constructor.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isComplete(): bool
    {
        return $this->complete;
    }

    public function setComplete(): void
    {
        $this->complete = true;
    }

    public function isObsolete(): bool
    {
        return $this->obsolete;
    }

    public function setObsolete(): void
    {
        $this->obsolete = true;
    }

    public function addDepends(Step $step): void
    {
        $this->dependsOn[] = $step;
    }

    public function areAllDependentsComplete(): bool
    {
        foreach ($this->dependsOn as $dependent) {
            if (! $dependent->isComplete()) {
                return false;
            }
        }

        return true;
    }
}
