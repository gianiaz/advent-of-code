<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022\Day17;

class JetStreamGenerator
{
    /** @var \Generator<JetStream> */
    private \Generator $generator;
    private bool $isStarted = false;

    public function __construct(
        private readonly string $jetStream,
    ) {
        $this->generator = $this->nextJetStreamGenerator();
    }

    public function next(): JetStream
    {
        if ($this->isStarted) {
            $this->generator->next();
        } else {
            $this->isStarted = true;
        }

        return $this->generator->current();
    }

    private function nextJetStreamGenerator(): \Generator
    {
        $inputLength = strlen($this->jetStream);

        do {
            for ($i = 0; $i < $inputLength; ++$i) {
                yield JetStream::from($this->jetStream[$i]);
            }
        } while (true);
    }
}
