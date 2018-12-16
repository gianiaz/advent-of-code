<?php

declare(strict_types=1);

namespace Tests\Xmas2018\Day13;

use Jean85\AdventOfCode\Xmas2018\Day13\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /**
     * @dataProvider tickWithCrossingDataProvider
     */
    public function testTickWithCrossings(string $initialDirection, array $expectedDirections): void
    {
        $cart = new Cart($initialDirection, 0, 0);

        $this->assertSame($initialDirection, (string) $cart);

        foreach ($expectedDirections as $direction) {
            $cart->tick('+');
            $this->assertSame($direction, (string) $cart);
        }

        foreach ($expectedDirections as $direction) {
            $cart->tick('+');
            $this->assertSame($direction, (string) $cart);
        }
    }

    public function tickWithCrossingDataProvider(): array
    {
        return [
            [
                Cart::DIRECTION_LEFT,
                [
                    Cart::DIRECTION_DOWN,
                    Cart::DIRECTION_DOWN,
                    Cart::DIRECTION_LEFT,
                ],
            ],
        ];
    }

    /**
     * @dataProvider tickDataProvider
     */
    public function testTickWithSingleTracks(string $initialDirection, string $nextPieceOfTrack, string $expectedDirection): void
    {
        $cart = new Cart($initialDirection, 0, 0);

        $cart->tick($nextPieceOfTrack);

        $this->assertSame($expectedDirection, (string) $cart);
    }

    public function tickDataProvider(): array
    {
        return [
            [
                Cart::DIRECTION_LEFT,
                '-',
                Cart::DIRECTION_LEFT,
            ],
            [
                Cart::DIRECTION_RIGHT,
                '-',
                Cart::DIRECTION_RIGHT,
            ],
            [
                Cart::DIRECTION_UP,
                '|',
                Cart::DIRECTION_UP,
            ],
            [
                Cart::DIRECTION_DOWN,
                '|',
                Cart::DIRECTION_DOWN,
            ],
            [
                Cart::DIRECTION_DOWN,
                '/',
                Cart::DIRECTION_LEFT,
            ],
            [
                Cart::DIRECTION_RIGHT,
                '/',
                Cart::DIRECTION_UP,
            ],
            [
                Cart::DIRECTION_DOWN,
                '\\',
                Cart::DIRECTION_RIGHT,
            ],
            [
                Cart::DIRECTION_LEFT,
                '\\',
                Cart::DIRECTION_UP,
            ],
        ];
    }
}
