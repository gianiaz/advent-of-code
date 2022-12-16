<?php

declare(strict_types=1);

namespace Tests\Xmas2022\Day16;

use Jean85\AdventOfCode\Xmas2022\Day16\Valve;
use Jean85\AdventOfCode\Xmas2022\Day16\Vulcan;
use PHPUnit\Framework\TestCase;

class VulcanTest extends TestCase
{
    public function testSteps(): void
    {
        $vulcan = new Vulcan(Day16SolutionTest::TEST_INPUT);

        $this->assertValveName('AA', $vulcan->getCurrentValve());
        $this->assertSame(0, $vulcan->getMinute());
        $this->assertSame(0, $vulcan->getReleaseFlow());
        $this->assertSame(0, $vulcan->getReleasedPressure());

        $vulcan->stepTo($vulcan->getValve('DD'));

        $this->assertValveName('DD', $vulcan->getCurrentValve());
        $this->assertSame(1, $vulcan->getMinute());
        $this->assertSame(0, $vulcan->getReleaseFlow());
        $this->assertSame(0, $vulcan->getReleasedPressure());

        $vulcan->openCurrentValve();

        $this->assertValveName('DD', $vulcan->getCurrentValve());
        $this->assertSame(2, $vulcan->getMinute());
        $this->assertSame(20, $vulcan->getReleaseFlow());
        $this->assertSame(0, $vulcan->getReleasedPressure());

        $vulcan->stepTo($vulcan->getValve('BB'));

        $this->assertValveName('BB', $vulcan->getCurrentValve());
        $this->assertSame(4, $vulcan->getMinute());
        $this->assertSame(20, $vulcan->getReleaseFlow());
        $this->assertSame(40, $vulcan->getReleasedPressure());

        $vulcan->openCurrentValve();

        $this->assertValveName('BB', $vulcan->getCurrentValve());
        $this->assertSame(5, $vulcan->getMinute());
        $this->assertSame(33, $vulcan->getReleaseFlow());
        $this->assertSame(60, $vulcan->getReleasedPressure());

        $vulcan->stepTo($vulcan->getValve('JJ'));

        $this->assertValveName('JJ', $vulcan->getCurrentValve());
        $this->assertSame(8, $vulcan->getMinute());
        $this->assertSame(33, $vulcan->getReleaseFlow());
        $this->assertSame(159, $vulcan->getReleasedPressure());

        $vulcan->openCurrentValve();

        $this->assertValveName('JJ', $vulcan->getCurrentValve());
        $this->assertSame(9, $vulcan->getMinute());
        $this->assertSame(54, $vulcan->getReleaseFlow());
        $this->assertSame(192, $vulcan->getReleasedPressure());

        $this->markTestIncomplete();
        $vulcan->stepTo($vulcan->getValve('HH'));
        $vulcan->stepTo($vulcan->getValve('EE'));
        $vulcan->stepTo($vulcan->getValve('CC'));
    }

    private function assertValveName(string $expectedName, Valve $valve): void
    {
        $this->assertSame($expectedName, $valve->name);
    }
}
