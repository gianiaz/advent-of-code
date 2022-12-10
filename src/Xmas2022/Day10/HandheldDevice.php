<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day10;

class HandheldDevice
{
    private int $registryX = 1;
    private int $tickCounter = 0;
    /** @var Instruction[] */
    private array $instructions = [];
    private ?Instruction $currentInstruction = null;

    public function loadInstructions(string $input): void
    {
        foreach (explode(PHP_EOL, $input) as $row) {
            $this->instructions[] = Instruction::parse(trim($row));
        }
    }

    public function startCycle(): void
    {
        ++$this->tickCounter;
        if (null === $this->currentInstruction) {
            $this->currentInstruction = array_shift($this->instructions);
        }
    }

    public function completeCycle(): void
    {
        $this->currentInstruction->tick();

        if ($this->currentInstruction->isCompleted()) {
            $this->registryX += $this->currentInstruction->value;
            $this->currentInstruction = null;
        }
    }

    public function getRegistryX(): int
    {
        return $this->registryX;
    }

    public function getTickCounter(): int
    {
        return $this->tickCounter;
    }

    public function getSignalStrenght(): int
    {
        return $this->registryX * $this->tickCounter;
    }
}
