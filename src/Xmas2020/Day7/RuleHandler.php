<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day7;

class RuleHandler
{
    /** @var array<string, Rule[]> */
    private array $rules = [];

    public function __construct(string $input)
    {
        foreach (explode("\n", $input) as $writtenRule) {
            foreach ($this->createRules($writtenRule) as $rule) {
                $this->rules[$rule->getMayContain()][] = $rule;
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
        $startRules = $this->rules[$color] ?? [];
        if (empty($startRules)) {
            return [];
        }

        $holdBy = [];

        foreach ($startRules as $rule) {
            $holdBy = array_merge($holdBy, [$rule->getColor()], $this->whichColorsMayContain($rule->getColor()));
        }

        return array_unique($holdBy);
    }
}
