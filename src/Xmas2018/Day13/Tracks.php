<?php

namespace Jean85\AdventOfCode\Xmas2018\Day13;

class Tracks
{
    /** @var string[] */
    private $tracks;

    /** @var Cart[] */
    private $carts;

    public function __construct(string $input)
    {
        $y = 0;
        foreach (explode(PHP_EOL, $input) as $y => $row) {
            $this->tracks[$y] = $row;

            foreach (str_split($row) as $x => $char) {
                $this->addCart($char, $x, $y);
            }
        }
    }

    public function getActualSituation(): string
    {
        $situation = $this->tracks;

        foreach ($this->carts as $cart) {
            $situation[$cart->getY()][$cart->getX()] = $cart->__toString();
        }

        return implode(PHP_EOL, $situation);
    }

    /**
     * @return Cart[]
     */
    public function getCarts(): array
    {
        return $this->carts;
    }

    private function addCart(string $char, int $x, int $y): void
    {
        switch ($char) {
            case Cart::DIRECTION_UP:
            case Cart::DIRECTION_DOWN:
            case Cart::DIRECTION_RIGHT:
            case Cart::DIRECTION_LEFT:
                $cart = new Cart($char, $x, $y);
                $this->carts[$cart->getCoordHash()] = $cart;
                $this->tracks[$y][$x] = $this->replaceCartWithTracks($char);
        }
    }

    private function replaceCartWithTracks(string $char): string
    {
        switch ($char) {
            case Cart::DIRECTION_DOWN:
            case Cart::DIRECTION_UP:
                return '|';
            case Cart::DIRECTION_RIGHT:
            case Cart::DIRECTION_LEFT:
                return '-';
        }
    }
}
