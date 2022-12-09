<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day9;

use Jean85\AdventOfCode\Xmas2022\Day9\Coordinates;
use Jean85\AdventOfCode\Xmas2022\Day9\Instruction;
use Jean85\AdventOfCode\Xmas2022\Day9\Rope;
use PHPUnit\Framework\TestCase;

class RopeTest extends TestCase
{
    public function testMovements(): void
    {
        $rope = new Rope();

        $rope->apply(new Instruction('R 4'));

        $this->assertEquals(new Coordinates(4, 0), $rope->head);

        $rope->apply(new Instruction('U 4'));

        $this->assertEquals(new Coordinates(4, 4), $rope->head);

        $rope->apply(new Instruction('L 3'));

        $this->assertEquals(new Coordinates(1, 4), $rope->head);

        $rope->apply(new Instruction('D 1'));

        $this->assertEquals(new Coordinates(1, 3), $rope->head);

        $rope->apply(new Instruction('R 4'));

        $this->assertEquals(new Coordinates(5, 3), $rope->head);

        $rope->apply(new Instruction('D 1'));

        $this->assertEquals(new Coordinates(5, 2), $rope->head);

        $rope->apply(new Instruction('L 5'));

        $this->assertEquals(new Coordinates(0, 2), $rope->head);

        $rope->apply(new Instruction('R 2'));

        $this->assertEquals(new Coordinates(2, 2), $rope->head);
    }
}
