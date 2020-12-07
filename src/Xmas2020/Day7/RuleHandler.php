<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day7;

class RuleHandler
{
    /** @var array<string, Rule[]> */
    private array $rulesMayContain = [];
    /** @var array<string, Rule[]> */
    private array $rulesByColor = [];

    public function __construct(string $input)
    {
        foreach (explode("\n", $input) as $writtenRule) {
            foreach ($this->createRules($writtenRule) as $rule) {
                $this->rulesMayContain[$rule->getMayContain()][] = $rule;
                $this->rulesByColor[$rule->getColor()][] = $rule;
            }
        }
    }

    /**
     * @return Rule[]
     */
    private function createRules(string $rule): array
    {
        $newRules = [];
        $splitRule = explode(' bags contain ', $rule);

        foreach (explode(', ', $splitRule[1]) as $canContain) {
            if ($canContain === 'no other bags.') {
                $newRules[] = new Rule($splitRule[0], 'no other bags', 0);
            } else {
                preg_match('/(\d)+ (\w+\s\w+) bag/', $canContain, $matches);
                $newRules[] = new Rule($splitRule[0], $matches[2], (int) $matches[1]);
            }
        }

        return $newRules;
    }

    /**
     * @return string[]
     */
    public function whichColorsMayContain(string $color): array
    {
        $startRules = $this->rulesMayContain[$color] ?? [];
        if (empty($startRules)) {
            return [];
        }

        $holdBy = [];

        foreach ($startRules as $rule) {
            $holdBy = array_merge($holdBy, [$rule->getColor()], $this->whichColorsMayContain($rule->getColor()));
        }

        return array_unique($holdBy);
    }

    public function countColorsContainedInto(string $color): int
    {
        $startRules = $this->rulesByColor[$color] ?? [];
        $total = 0;

        foreach ($startRules as $rule) {
            if ($rule->getCount()) {
                $total += $rule->getCount();
                $total += $rule->getCount() * $this->countColorsContainedInto($rule->getMayContain());
            }
        }

        return $total;
    }
}
