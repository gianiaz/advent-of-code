<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2022;

use Webmozart\Assert\Assert;

class Input
{
    public static function read(string $dir): string
    {
        Assert::directory($dir);
        $fileName = $dir . DIRECTORY_SEPARATOR . 'input.txt';
        Assert::fileExists($fileName);

        return trim(file_get_contents($fileName));
    }
}
