<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day3;

class Claim
{
    /** @var string */
    private $id;

    /** @var int */
    private $left;

    /** @var int */
    private $top;

    /** @var int */
    private $width;

    /** @var int */
    private $height;

    /**
     * Claim constructor.
     */
    public function __construct(string $id, int $left, int $top, int $width, int $lenght)
    {
        $this->id = $id;
        $this->left = $left;
        $this->top = $top;
        $this->width = $width;
        $this->height = $lenght;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLeft(): int
    {
        return $this->left;
    }

    public function getTop(): int
    {
        return $this->top;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
