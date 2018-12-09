<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day7;

class Worker
{
    /** @var int */
    private $baseTime;

    private $timeSpent = 0;

    /** @var Step */
    private $currentStep;

    /**
     * Worker constructor.
     */
    public function __construct(int $baseTime)
    {
        $this->baseTime = $baseTime;
    }

    public function isFree(): bool
    {
        return $this->currentStep === null;
    }

    public function getCurrentStep(): ?Step
    {
        return $this->currentStep;
    }

    public function tick(): void
    {
        if ($this->currentStep === null) {
            return;
        }

        ++$this->timeSpent;

        if ($this->timeSpent >= ($this->baseTime + $this->currentStep->getCost())) {
            $this->currentStep->setComplete();
            $this->currentStep = null;
            $this->timeSpent = 0;
        }
    }

    public function setCurrentStep(Step $currentStep): void
    {
        $this->currentStep = $currentStep;
    }
}
