<?php

declare(strict_types=1);

namespace Tests\Xmas2019\Day4;

use Jean85\AdventOfCode\Xmas2019\Day4\StricterPassword;
use PHPUnit\Framework\TestCase;

class StricterPasswordTest extends TestCase
{
    /**
     * @dataProvider validPasswordProvider
     */
    public function testIsValid(int $value): void
    {
        $this->assertTrue((new StricterPassword($value))->isValid());
    }

    /**
     * @dataProvider invalidPasswordProvider
     */
    public function testIsInvalid(int $value): void
    {
        $this->assertFalse((new StricterPassword($value))->isValid());
    }

    public function validPasswordProvider(): array
    {
        return [
            [112345],
            [112233],
            [111122],
            [111223],
            [111233],
            [346678],
            [788999],
            [388999],
            [445555],
            [445556],
            [445557],
            [445558],
            [445559],
            [445666],
            [445777],
            [445888],
            [445999],
            [446666],
            [446667],
            [446668],
            [446669],
            [446777],
            [446888],
            [446999],
            [447777],
            [447778],
            [447779],
            [447888],
            [447999],
            [448888],
            [448889],
            [448999],
            [449999],
            [455666],
            [455777],
            [455888],
            [455999],
            [466777],
            [466888],
            [466999],
            [477888],
            [477999],
            [488999],
            [556666],
            [556667],
            [556668],
            [556669],
            [556777],
            [556888],
            [556999],
            [557777],
            [557778],
            [557779],
            [557888],
            [557999],
            [558888],
            [558889],
            [558999],
            [559999],
            [566777],
            [566888],
            [566999],
            [577888],
            [577999],
            [588999],
            [667777],
            [667778],
            [667779],
            [667888],
            [667999],
            [668888],
            [668889],
            [668999],
            [669999],
            [677888],
            [677999],
            [688999],
            [778888],
            [778889],
            [778999],
            [779999],
            [788999],
            [889999],
        ];
    }

    public function invalidPasswordProvider(): array
    {
        return [
            [111111],
            [111222],
            [222333],
            [122235],
            [222332],
            [121223],
            [123789],
            [123444],
            [333333],
            [699999],
        ];
    }
}
