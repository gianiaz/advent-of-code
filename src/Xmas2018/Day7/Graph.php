<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day7;

class Graph
{
    /** @var Step[] */
    private $steps = [];

    public function getStep(string $name): Step
    {
        if (! \array_key_exists($name, $this->steps)) {
            $this->steps[$name] = new Step($name);
        }

        return $this->steps[$name];
    }

    public function getFirstAvailable(): ?Step
    {
        $availables = array_filter($this->steps, function (Step $step) {
            return $step->areAllDependentsComplete() && ! $step->isObsolete();
        });
        ksort($availables);

        return array_shift($availables);
    }
}
