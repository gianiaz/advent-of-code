<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day2;

class Password
{
    private string $password;
    private Policy $policy;

    public function __construct(string $password, Policy $policy)
    {
        $this->password = $password;
        $this->policy = $policy;
    }

    public function isValid(): bool
    {
        $charCount = 0;

        foreach (str_split($this->password) as $char) {
            if ($char === $this->policy->getChar()) {
                ++$charCount;

                if ($charCount > $this->policy->getMax()) {
                    return false;
                }
            }
        }

        return $charCount >= $this->policy->getMin();
    }

    public function isValidWithTheNewPolicy(): bool
    {
        return $this->policy->getChar() === ($this->password[$this->policy->getMin() - 1] ?? '')
            xor $this->policy->getChar() === ($this->password[$this->policy->getMax() - 1] ?? '');
    }
}
