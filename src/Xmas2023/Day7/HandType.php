<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2023\Day7;

enum HandType: int
{
    case FiveOfAKind = 7;
    case FourOfAKind = 6;
    case FullHouse = 5;
    case ThreeOfAKind = 4;
    case TwoPair = 3;
    case OnePair = 2;
    case HighCard = 1;
}
