<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day9;

use Jean85\AdventOfCode\Xmas2022\Day9\Coordinates;
use Jean85\AdventOfCode\Xmas2022\Day9\Instruction;
use Jean85\AdventOfCode\Xmas2022\Day9\RopeWithMultipleKnots;
use PHPUnit\Framework\TestCase;

class RopeWithMultipleKnotsTest extends TestCase
{
    public function testBaseCase(): void
    {
        $rope = new RopeWithMultipleKnots(10);

        $rope->apply(new Instruction('R 4'));

        $this->assertEquals(new Coordinates(4, 0), $rope->getKnot(0));
        $this->assertEquals(new Coordinates(3, 0), $rope->getKnot(1));
        $this->assertEquals(new Coordinates(2, 0), $rope->getKnot(2));
        $this->assertEquals(new Coordinates(1, 0), $rope->getKnot(3));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(4));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(5));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(6));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(7));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(8));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(9));

        // split U 4 into four U 1
        $rope->apply(new Instruction('U 1'));

        $this->assertEquals(new Coordinates(4, 1), $rope->getKnot(0));
        $this->assertEquals(new Coordinates(3, 0), $rope->getKnot(1));
        $this->assertEquals(new Coordinates(2, 0), $rope->getKnot(2));
        $this->assertEquals(new Coordinates(1, 0), $rope->getKnot(3));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(4));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(5));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(6));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(7));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(8));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(9));

        $rope->apply(new Instruction('U 1'));

        $this->assertEquals(new Coordinates(4, 2), $rope->getKnot(0));
        $this->assertEquals(new Coordinates(4, 1), $rope->getKnot(1));
        $this->assertEquals(new Coordinates(3, 1), $rope->getKnot(2));
        $this->assertEquals(new Coordinates(2, 1), $rope->getKnot(3));
        $this->assertEquals(new Coordinates(1, 1), $rope->getKnot(4));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(5));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(6));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(7));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(8));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(9));

        $rope->apply(new Instruction('U 1'));
        $rope->apply(new Instruction('U 1'));

        $this->markTestIncomplete('Correct up to this point');

        $this->assertEquals(new Coordinates(4, 4), $rope->getKnot(0));
        $this->assertEquals(new Coordinates(4, 3), $rope->getKnot(1));
        $this->assertEquals(new Coordinates(4, 2), $rope->getKnot(2));
        $this->assertEquals(new Coordinates(3, 2), $rope->getKnot(3));
        $this->assertEquals(new Coordinates(2, 2), $rope->getKnot(4));
        $this->assertEquals(new Coordinates(1, 1), $rope->getKnot(5));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(6));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(7));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(8));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(9));

        $rope->apply(new Instruction('L 3'));

        $this->assertEquals(new Coordinates(1, 4), $rope->getKnot(0));

        $rope->apply(new Instruction('D 1'));

        $this->assertEquals(new Coordinates(1, 3), $rope->getKnot(0));

        $rope->apply(new Instruction('R 4'));

        $this->assertEquals(new Coordinates(5, 3), $rope->getKnot(0));

        $rope->apply(new Instruction('D 1'));

        $this->assertEquals(new Coordinates(5, 2), $rope->getKnot(0));

        $rope->apply(new Instruction('L 5'));

        $this->assertEquals(new Coordinates(0, 2), $rope->getKnot(0));

        $rope->apply(new Instruction('R 2'));

        $this->assertEquals(new Coordinates(2, 2), $rope->getKnot(0));
    }

    public function testAdvancedCase(): void
    {
        $rope = new RopeWithMultipleKnots(10);

        $rope->apply(new Instruction('R 5'));

        $this->assertEquals(new Coordinates(5, 0), $rope->getKnot(0));
        $this->assertEquals(new Coordinates(4, 0), $rope->getKnot(1));
        $this->assertEquals(new Coordinates(3, 0), $rope->getKnot(2));
        $this->assertEquals(new Coordinates(2, 0), $rope->getKnot(3));
        $this->assertEquals(new Coordinates(1, 0), $rope->getKnot(4));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(5));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(6));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(7));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(8));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(9));

        $rope->apply(new Instruction('U 8'));

        $this->assertEquals(new Coordinates(5, 8), $rope->getKnot(0));
        $this->assertEquals(new Coordinates(5, 7), $rope->getKnot(1));
        $this->assertEquals(new Coordinates(5, 6), $rope->getKnot(2));
        $this->assertEquals(new Coordinates(5, 5), $rope->getKnot(3));
        $this->assertEquals(new Coordinates(5, 4), $rope->getKnot(4));
        $this->markTestIncomplete('Correct up to this point');
        $this->assertEquals(new Coordinates(4, 4), $rope->getKnot(5));
        $this->assertEquals(new Coordinates(3, 3), $rope->getKnot(6));
        $this->assertEquals(new Coordinates(2, 2), $rope->getKnot(7));
        $this->assertEquals(new Coordinates(1, 1), $rope->getKnot(8));
        $this->assertEquals(new Coordinates(0, 0), $rope->getKnot(9));

        $rope->apply(new Instruction('L 8'));

        $this->assertEquals(new Coordinates(-3, 8), $rope->getKnot(0));

        $rope->apply(new Instruction('D 3'));

        $this->assertEquals(new Coordinates(-3, 5), $rope->getKnot(0));

        $rope->apply(new Instruction('R 17'));

        $this->assertEquals(new Coordinates(14, 5), $rope->getKnot(0));

        $rope->apply(new Instruction('D 10'));

        $this->assertEquals(new Coordinates(14, -5), $rope->getKnot(0));

        $rope->apply(new Instruction('L 25'));

        $this->assertEquals(new Coordinates(-11, -5), $rope->getKnot(0));

        $rope->apply(new Instruction('U 20'));

        $this->assertEquals(new Coordinates(-11, 15), $rope->getKnot(0));
    }
}
