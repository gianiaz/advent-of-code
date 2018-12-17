<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day13;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day13Solution implements SolutionInterface, SecondPartSolutionInterface
{
    /** @var string */
    private $input;

    /**
     * Day13Solution constructor.
     *
     * @param string $input
     */
    public function __construct(string $input = null)
    {
        $this->input = $input ?? $this->getTracks();
    }

    public function solve()
    {
        $tracks = new Tracks($this->input);

        do {
            $tracks->tick();
        } while ([] === $tracks->getCrashedCarts());

        return $tracks->getCrashedCarts()[0]->getCoordHash();
    }

    public function solveSecondPart()
    {
        $tracks = new Tracks($this->input);

        do {
            $tracks->tick();
        } while (\count($tracks->getCarts()) > 1);

        $carts = $tracks->getCarts();
        /** @var Cart $remainingCart */
        $remainingCart = \array_pop($carts);

        return $remainingCart->getCoordHash();
    }

    private function getTracks(): string
    {
        return
'            /--------------------------------------------------------\                           /------------------------------------------------\   
            |             /------------------------------------------+---------------------------+--------------------------\                     |   
            |             |                             /------------+---------------------------+----------\    /--------\ |                     |   
            |             |   /-------------------------+---\        |                           |          |    |        | |                     |   
            |             |   |                         |   |        |            /--------------+----------+----+--------+-+---------------------+-\ 
 /----------+-------\     |   |                         |   |        |     /------+--------------+----------+----+----\   | |                     | | 
 |          |       |     |   |                         | /-+--------+-----+------+--------------+----------+----+----+---+-+----\                | | 
 |  /-------+-------+-----+-\ |                         | | |        |     |      |              |          |    |    |   | |    |                | | 
 |  |      /+-------+-----+-+-+\     /------------------+-+-+--------+-----+-----\|              |          |    |    |   | |    |                | | 
 | /+------++-\     |     | | ||     |                /-+-+-+--------+-----+-----++------\       |          |    |    |   | |    |                | | 
 | ||      || |     |     |/+-++-----+----------------+-+-+-+--------+-----+-----++------+----\  \----------+----+----+---+-+----+----------------/ | 
 | ||      || |     |    /+++-++-----+----------------+-+-+-+--------+-----+----\||      |    |             |    |    |   | |    |                  | 
 | ||      || |     |    |||| ||   /-+----------------+-+-+-+--------+-----+----+++------+----+-------------+----+----+---+-+----+-------\          | 
 | ||      || |     |    |||| ||/--+-+----------------+-+-+-+--------+-----+----+++------+->--+-------------+----+--\ |   | |    |       |          | 
 | ||      || |     |  /-++++-+++--+-+----------------+-+-+\|        |     \----+++------+----+-------------+----+--+-/   | |    |       |          | 
 | ||     /++-+-----+--+-++++-+++--+-+----------------+-+-+++--------+----------+++------+----+-----\       |    |  |     | |    |       |          | 
 | ||     ||| |     |  | |||| |||  | |                | | |||        |          |||    /-+----+-----+-------+----+--+-----+-+----+-----\ |          | 
 | ||     ||| |     |  | |||| |||/-+-+----------------+-+-+++--------+----------+++--\ | |    |     |       |    \--+-----/ |    |     | |          | 
 | ||     ||| |     |/-+-++++-++++-+-+----------------+-+-+++--------+----------+++--+-+-+----+-----+-------+-------+\      |    |     | |          | 
 | ||     ||| |     || | |||| |||| | |               /+-+-+++--------+----------+++-\| | |    |     |       |       ||      |    |     | |          | 
 | ||     ||| |/----++-+-++++-++++-+-+------\     /--++-+-+++------<-+----------+++-++-+-+----+-----+-------+-------++-----\|    |     | |          | 
 | ||     |\+-++----++-+-++++-+/|| | |      |     |  || | |||/-------+-------\  ||| || | | /--+-----+-------+-------++-----++----+-----+-+---\      | 
 | |\-----+-+-++----++-+-+++/ | || | |      |    /+--++-+-++++-------+-------+--+++-++-+-+-+--+-----+-------+-----\ ||     ||    |     | |   |      | 
 | |      | | ||    || | |||  | || | |    /-+----++--++-+-++++------\|       |  ||| || | |/+--+-----+---\   |     | ||     ||    |     | |   |      | 
 | |      | | ||    || \-+++--+-++-+-+----+-+----++--++-+-+/||      ||       |  ||| || | |||  |     |   | /-+-----+-++---\ ||    |     | |   |      | 
 | |      | | ||  /-++---+++--+-++-+-+-\  | |    ||  || | | ||      ||/------+--+++-++-+-+++--+-----+---+-+-+-----+-++---+-++----+--\  | |   |      | 
 | |      | | ||  | ||   |||  | || | | |  | |    || /++-+-+-++------+++------+--+++-++-+-+++--+-----+---+-+-+--\  | ||   | ||    |  |  | |   |      | 
 | |      | |/++--+-++---+++\ | || | | | /+-+----++-+++-+-+-++------+++------+--+++-++-+-+++--+-----+---+-+-+--+--+-++---+-++----+--+--+-+---+-----\| 
 | |      | ||||  | ||   |||| | || | | | || |    ||/+++-+-+-++------+++------+--+++-++-+-+++--+-----+---+-+-+--+--+\||   | ||    |  |  | |   |     || 
 | |      | ||||  | ||   |||| | || | | | || |    |\++++-+-+-++------+++------+--+++-++-+-+++--+-----+---+-+-+--+--++++---+-/|    |  |  | |   |     || 
 | |      | ||||  | ||   |||| | || | | | || |    | |||| | | ||      |||    /-+--+++-++-+-+++--+-----+---+-+-+--+--++++--\|  |    |  |  | |   |     v| 
 | |      | ||||  | ||   |||| | \+-+-+-+-++-+----+-++++-+-+-++------+++----+-+--+++-++-+-+++--+-----+---+-+-+--+--++/|  ||  |    |  | /+-+---+--\  || 
 | |      | ||||  | ||   |||| | /+-+-+-+-++-+----+-++++-+-+-++------+++----+-+--+++-++-+-+++--+-----+---+-+-+--+--++-+--++--+----+--+-++-+-\ |  |  || 
 | |      | ||||  | ||   |||| | || | | | || |    |/++++-+-+-++------+++----+-+--+++-++-+-+++--+-----+---+-+-+--+--++-+\ ||  |    |  | || | | |  |  || 
 | |      | ||||  | ||   |||| | || | | | || | /--++++++-+-+-++------+++----+\|  ||| || | |||  |  /--+---+-+-+--+--++-++-++--+----+--+-++\| | |  |  || 
 | |    /-+-++++--+-++---++++-+-++-+-+-+-++-+-+--++++++-+-+-++------+++----+++-\||| || | |||  |  |  |   | | |  |  || || ||  |    |  | |||| | |  |  || 
 | |    | | ||||  | ||   |||| | || | | | || | |  |||||| | | ||      |||    |||/++++-++-+-+++--+--+--+---+-+-+--+--++-++-++--+\   |  | |||| | |  |  || 
 | |    | | ||||  | ||   |||| | || | | ^ || | |  |||||| | | ||      |||/---++++++++-++-+-+++--+--+--+---+-+-+--+--++-++-++--++\  |  | |||| | |  |  || 
 | \----+-+-++/|  | ||   |||| | || | | | || | |  |||||| | | ||      ||||   |||||||| || | ||| /+--+--+-\ | | |  |  || || ||  |||  |  | |||| | |  |  || 
 |      | | || |  |/++---++++-+-++-+-+-+-++-+-+--++++++-+-+-++------++++---++++++++-++-+-+++-++-\|  | | | | |  |  || || ||  |||  |  | |||| | |  |  || 
 |      | | || |  ||||   |||| | || | | |/++-+-+--++++++-+-+-++------++++---++++++++-++-+-+++-++-++--+-+-+-+-+-\|  || || ||  |||  |  | |||| | |  |  || 
 |      | | || |  ||||   |||| | \+-+-+-++++-+-+--++++++-+-+-++------++++---++++++++-++-+-+++-++-++--+-+-+-+-+-++--++-++-++--+++--+--+-++++-/ |  |  || 
 |      | | || |  ||||   |||| |  | | | |||| | |  |||||| | | ||/-----++++---++++++++-++-+-+++-++-++\ | | | | | ||  || || ||  |||  |  | ||||   |  |  || 
 |      | | || |  |||\---++++-+--+-+-+-++++-+-+--++++++-+-+-+++-----++++---++++++++-++-+-+++-++-+++-+-+-+-+-+-++--++-/| ||  |||  |  | |^||   |  |  || 
 |      | | || |  |||  /-++++-+--+-+-+-++++-+-+--++++++-+-+-+++-----++++---++++++++-++\| ||| || ||| | | | | | ||  ||  | ||  ||| /+--+-++++---+--+\ || 
 |      | | || |  |||  | |||| |  | |/+-++++-+-+--++++++-+-+-+++-----++++---++++++++-++++-+++\|| ||| | | | | | ||  ||  | ||  ||| ||  | ||||   |  || || 
 |      | | || |  |||  | |||| |  | ||| |||\-+-+--++++++-+-+-+++-----/|||   |||||||| |||| |||||| ||| | | | | | ||  ||  | ||  ||| ||  | ||||   |  || || 
 |      | | \+-+--+++--+-++++-+--+-+++-+++--+-+--++++++-+-+-+++------/||   |||||||| |||| |||||| ||| | | | | | ||  ||  | ||  ||| ||  | ||||   |  || || 
 |      | |  | |  |||  |/++++-+--+-+++-+++--+-+--++++++-+-+-+++-------++---++++++++-++++-++++++-+++-+-+-+-+\| ||  ||  | ||  ||| ||  | ||||   |  || || 
 |      | |  | |  \++--++++++-+--+-+++-/||  | |  |||||| | | |||  /----++---++++++++-++++-++++++-+++-+-+-+-+++-++--++--+-++--+++\||  | ||||   |  || || 
 |      | |  | |   ||  |||||| |  \-+++--++--+-+--++++++-+-+-+++--+----++---++++++++-+/|| |||||| ||| | | | \++-++--++--+-+/  ||||||  | ||||   |  || || 
 |      | |  | |   ||  |||||| |    |||  ||  | |  |||||| | | |||  |    ||   |||||||| | || |||||| ||| | | |  || ||  ||  | |   ||||||  | ||||   |  || || 
 |      | |  | |   ||  |||||| |    |||  ||  | |  ||||||/+-+-+++--+----++---++++++++-+-++-++++++-+++-+-+-+--++-++--++--+-+-\ ||||||  | ||||   |  || || 
 |      | |  | |   ||  |||||| |    |||  ||  | |  |||||||| | |||  |    ||   |||\++++-+-++-++++++-+++-+-+-+--++-++--++--+-+-+-+/||||  | ||||   |  || || 
 |      | |  |/+---++--++++++-+----+++--++--+-+--++++++++-+-+++--+----++---+++-++++-+-++-++++++-+++-+\| |  || ||  ||  | | | | ||||  | ||||   |  || || 
 |      | \--+++---++--++++++-+----+++--++--+-+--++++++++-+-+++--+----++---+++-++++-+-++-++++++-+++-/|| |  || ||  ||  | | | | ||||  | ||||   |  || || 
 |      |    |||   ||  \+++++-+----+++--++--+-+--++++++++-+-+++--+----++---+++-++++-+-/| |||||| |||  || |  || ||  ||  | | | | ||||  | ||||   |  || || 
 \------+----+++---+/ /-+++++-+----+++--++--+-+--++++++++-+-+++--+----++---+++-++++-+--+-++++++-+++-\|| |  ||/++--++--+-+\| | ||||  | ||||   |  || || 
        |    |||   |  | ||||| |    |||  ||  | |  |||||||| | |||  | /--++---+++-++++-+--+-++++++-+++<+++-+--+++++--++\ | ||| | ||||  | ||||   |  || || 
        |    |||   |  | ||||| |    |||  ||/-+-+--++++++++-+-+++--+-+--++---+++-++++-+--+-++++++-+++-+++-+--+++++--+++-+-+++-+-++++--+-++++---+\ || || 
        |    |||   |/-+-+++++-+----+++--+++-+-+--++++++++-+-+++--+-+\ ||   ||| |||| |  | |||||| ||| ||| |  |||||  ||| | ||| | ||||  | ||||   || || || 
        |    |||   || | ||||| |    |||  ||| | |  |||||||| | |||/-+-++-++---+++-++++-+--+-++++++-+++-+++-+--+++++--+++-+-+++-+-++++-\| ||||   || || || 
        |    |||   || | ||||| |    |||  ||| | |  |||||||| | |||| | || ||   ||| |||| |  | |||||| ||| ||| |  |||||  ||| | ||| | |||| || ||||   || || || 
 /------+----+++---++-+-+++++-+----+++--+++-+-+--++++++++-+-++++-+-++-++\  ||| |||| |  | |||||| ||| ||| |  |||||  ||| | ||| | |||| || ||||   || || || 
 |      |    |||   || | ||||| |    ||\--+++-+-+--++++++++-+-++++-+-++-+++--+++-++/| |  \-++++++-+++-+++-+--+++++--+++-+-+++-+-++++-++-+/||   || || || 
 |      |    \++---++-+-++++/ |    ||   ||| | |  |||||||| | |||| | || |||  ||| || | |    |||||| ||| ||| |  |||||  ||| | ||| | |||| || \-++---++-/| || 
 |      |     ||   || | ||||  |/---++---+++-+-+--++++++++-+-++++-+-++-+++--+++-++-+-+----++++++-+++-+++-+--+++++--+++-+-+++-+-++++-++--\||   ||  | || 
 |      |     ||   || | ||||  ||   ||   ||| | |  ||||||\+-+-++++-+-++-+++--+++-++-+-+----++++++-+++-+++-+--+++++--+++-+-++/ | |||| ||  |||   ||  | || 
 |      |     ||   || | ||||  ||   ||   ||| | |  |||\++-+-+-++++-+-++-+++--+++-++-+-+----++++++-+++-+++-+--++++/  ||| | ||  | |||| ||  |||   ||  | || 
 |      |  /--++---++-+-++++--++---++---+++-+-+--+++-++-+-+-++++-+-++-+++--+++-++-+-+---\|\++++-+++-+++-/  ||||   ||| | ||  | |||| ||  |||   ||  | || 
 |      |  |  ||   || | ||||  ||   ||   |\+-+-+--+++-++-+-+-++++-+-++-+++--+++-++-+-+---++-++++-+++-+++----++++---+++-+-++--+-++++-++--+++---++--+-/| 
 |      |  |  ||   || | ||||  ||   ||   | |/+-+--+++-++-+-+-++++-+-++-+++--+++-++-+-+---++-++++-+++-+++----++++---+++-+-++-\| |||| ||  |||   ||  |  | 
 |      |  |  ||   || | ||||  || /-++->-+-+++-+--+++-++-+\| |||| | || |||  ||| || | |   || |||| ||| |||    ||||   ||| | || || |||| ||  |||   ||  |  | 
 |      |  |  ||   || | ||||  || | ||   | ||| |  ||| |\-+++-++++-+-++-+++--+++-++-+-+---+/ |||| ||| |||    ||||   ||| | || || |||| ||  |||   ||  |  | 
 |      |  |  ||   || | |||| /++-+-++---+-+++-+\ ||| |  ||| ||||/+-++-+++--+++-++-+-+---+--++++-+++-+++----++++---+++>+\|| || |||| ||  |||   ||  |  | 
 |      |  |  ||   || | |||| ||| | ||   | ||| || ||| |  ||| |||||| || |||  ||| || | |  /+--++++-+++-+++----++++---+++-++++-++-++++-++--+++---++--+--+\
 |      |  |  ||   || | |||\-+++-+-++---+-+++-++-+++-+--+++-++++++-++-+++--+++-++-+-+--++--+++/ ||| |||    ||||   ||| |||| || |||| ||  |||   ||  |  ||
 | /----+--+--++---++-+-+++--+++-+-++---+-+++-++-+++-+--+++-++++++-++-+++--+++-++-+-+--++--+++--+++-+++--\ ||\+---+++-+++/ || |||| ||  |||   ||  |  ||
 | |    |  |  ||   || | |||  ||| | ||   | ||| || ||| |  ||| |||\++-++-+++--+++-++-+-+--++--+++--+++-+++--+-++-+---+++-+++--++-++++-/|  |||   ||  |  ||
 | |    |  |  ||   || | |||  ||| | ||   | ||| || ||| |  ||| ||| || || |||  ||| || | |  ||  |||  ||| ||| /+-++-+---+++-+++--++-++++--+\ |||   ||  |  ||
 | |  /-+--+--++---++-+-+++--+++-+\||   | ||| || ||| |  ||| ||\-++-++-+++--+++-++-+-+--++--+++--++/ ||| || || |   ||| |||  || |||| /++-+++---++--+\ ||
 | |  | |  |  ||   || | |||  ||| ||||   | ||| || ||| |  ||| ||  || || |||  ||| || | |  ||  ||\--++--++/ || || |   ||| |||  || |||| ||| |||   ||  || ||
 | |  | |  |  ||   || | |||  ||| ||||   | ||| || ||| |  ||| ||  || || |||  ||| || | |  ||  ||   ||  ||  || || |   ||| |||  || |||| ||| |||   ||  || ||
 | |  | |/-+--++---++-+-+++--+++-++++---+-+++-++-+++-+--+++-++\ || || |||  \++-++-+-+--++--++---++--++--++-++-+---+++-++/  || |||| ||| |||   ||  || ||
 | |  | || |  ||   || | |||  |\+-++++---+-+++-++-+++-+--+++-/|| || || |||   || || | |  ||  ||   ||  ||  || || |   ||| ||   || |||| ||| |||   ||  || ||
 | |  | || |  ||   || | |||  | | ||||   | ||| \+-+++-+--+++--++-++-++-+++---/| || | |  ||  ||   ||  ||  || || |   ||| ||   || |||| ||| |||   ||  || ||
 | |  | || |  ||   || | |||  | | ||||   | |||  | ||| |  |||  || || || |||    v || | |  ||  ||   ||  ||  || || |   ||| ||   || ||\+-+++-+++---++--/| ||
 | |  | || |  ||   || | |||  | | ||||   | |||  | ||| |  ||\--++-++-++-+++----+-++-+-+--++--++---++--++--++-++-+---+++-++---++-++-/ ||| |||   ||   | ||
 | |  | || |  ||   \+-+-+++--+-+-++++---+-+++--+-+++-+--++---++-++-++-+++----+-++-+-+--++--++---/|  ||  || || |   ||| ||   || ||   ||| |||   ||   | ||
 | |  | || |  ||    | | |||  | | ||||   | |\+--+-+++-+--++---++-++-++-+++----+-++-+-+--++--++----+--++--++-++-+---+++-++---/| ||   ||| |||   ||   | ||
/+-+--+-++-+--++---\| | |||  | | ||||   | | |  | ||| \--++---++-++-++-+++----+-++-+-/  ||  ||    |  ||  || || |   ||| ||    | ||   ||| |||   ||   | ||
|| |  | || |  \+---++-+-+++--+-+-++++---+-+-+--+-+++----++---++-++-++-+++----+-++-+----++--++----+--+/  || || |   ||| ||    | ||   ||| |||   ||   | ||
|| |  | || |   |   || | ||\--+-+-++++---+-+-+--+-+++----++---++-++-++-+++----+-++-+----++--++----+--+---++-++-+---+++-++----/ ||   ||| |||   ||   | ||
|| |  | || |   |   || | ||   | | ||||   | | |  | |||    ||   || || || |||    | || \----++--++----+--+---++-++-+---+++-++------++---+++-+++---++---+-/|
|| |  | || |   |   || | ||   | \-++++---+-+-+--+-+++----++---++-++-++-+++----+-++------++--++----+--+---++-++-+---+++-++------++---+++-/||   ||   |  |
|| |  | || |   |   || | ||   |   ||||   |/+-+--+-+++----++---++-++-++-+++----+-++------++--++----+--+---++-++-+---+++-++-<----++--\|||  ||   ||   |  |
|| |  | || |   |   || | ||   |   ||||   ||| |  | |||    ||   || || || |||    | ||      \+--++----+--+---++-++-+---+++-++------++--++++--++---++---+--/
|| |  | || |   |   || | ||   |   ||||  /+++-+--+-+++----++---++-++-++-+++----+-++-------+--++----+--+---++-++-+--<+++-++------++\ ||||  ||   ||   |   
|| |  | || |   |   || | ||   |   ||||  |||| |  | |||    ||   || || ||/+++----+-++-------+--++----+--+---++-++-+---+++-++----\ ||| ||||  ||   ||   |   
|| |  | || |   |   || | ||   |   |||| /++++-+--+\|||    \+---++-++-++++++----+-++-------+--++----+--+---++-+/ |   ||| ||    | ||| ||||  ||   ||   |   
|| |  | || |   |   || | \+---+---++++-+++++-+--+++++-----+---++-++-++++++----+-++-------+--++----+--+---++-/  |   ||| ||    | ||| ||||  ||   ||   |   
|| |  \-++-+---+---++-+--+---+---+/|| ||||| |  |||\+-----+---++-++-++++++----+-++-------+--++----+--+---++----+---+++-/|    | ||| ||||  ||   ||   |   
|| |    || |  /+---++-+--+---+---+-++-+++++-+--+++-+----<+---++-++-++++++----+-++\   /--+--++----+--+---++----+---+++--+-\  | ||| ||||  ||   ||   |   
|| |/---++-+--++---++\|  \---+---+-++-+++++-+--+++-+-----+---++-++-++++++----+-+/|   |  |  ||    |  |   \+----+---+++--+-+--+-+++-+++/  ||   ||   |   
|| ||   || |  ||   ||||      |   | || ||||| |  ||| |     |   || || ||||||    | | |   |  |  ||    |  |    |    |   |||  | |  | ||| |||   ||   ||   |   
|| ||   |\-+--++---++++------+---+-++-+++++-+--+++-+-----+---+/ || ||||||    | | |   |  |  ||    |  |    |   /+---+++-\| |  | ||| |||   ||   ||   |   
|| ||   |/-+--++---++++------+---+-++-+++++-+--+++-+-----+---+--++-++++++----+-+-+---+--+--++----+--+-\  |   ||   ||| || |  |/+++-+++--\||   ||   |   
|| ||   || |  ||   |||\------+---+-++-+++++-+--+++-+-----+---+--++-++++++----+-+-+---+--+--++----+--/ |  |   ||   ||| || |  ||||| |||  |||   ||   |   
||/++---++-+--++---+++----\  |   | || ||||| |  ||| | /---+---+--++-++++++----+-+-+---+--+--++----+----+--+---++---+++-++-+--+++++-+++\ |||   ||   |   
|||||   || |  ||   |||    |  |   | \+-+++++-+--+++-+-+---+---+--++-++++++----+-+-+---+--+--++----+----+--+---++---+++-++-+--+++++-++++-++/   ||   |   
|||||   || |  ||   |||    |  |   |  | ||\++-+--+++-+-+---+---+--++-++++++----+-+-+---+--+--++----+----+--+---+/   ||| || |  ||||| |||| ||    ||   |   
||||| /-++-+--++---+++-\  |  |   \--+-++-++-+--+++-+-+---/   |  || |||||| /--+-+-+---+--+--++----+----+--+---+----+++-++-+--+++++-++++-++----++---+--\
\++++-+-++-+--++---/|| |  |  |      | || || |  ||| | |       |  || |||\++-+--+-+-+---+--+--++----+----+--+---+----+++-++-+--+++++-++/| ||    ||   |  |
 |||| | || |  ||    || |  |  |      | || || |  ||| \-+-------+--++-+++-++-+--+-+-+---+--+--++----+----+--+---+----+/| || |  ||||| || | ||    ||   |  |
 |||| | || |  ||    || |  |  |      | || || |  |||   |       |  || ||| || |  | | |   |  |  ||    |    |  |   \----+-+-/| |  ||||| || | ||    ||   |  |
 |||| | || |  ||    || |  |  |      | || || |  |||   |       |  || ||| \+-+--+-+-+---+--+--++----+----+--+--------+-+--+-+--++/|| || | ||    ||   |  |
 ||\+-+-++-+--++----++-+--+--+------+-++-++-+--+++---+-------+--++-+++--+-+--+-+-+---+--+--++----+----+--/        | |  | |  || || || | ||    ||   |  |
 || \-+-++-+--++----+/ |  |  |      | || || |  |||   |       |  || |||  | |  | | |   |  |  ||  /-+----+-----------+-+--+-+--++-++\|| | ||    ||   |  |
 ||   | \+-+--++----+--+--+--+------+-++-++-+--+++---+-------+--++-+++--+-+--+-/ |   |  |  \+--+-+----+<----------+-+--+-+--++-+++++-+-++----/|   |  |
 ||   |  | |  |\----+--+--+--+------+-++-++-/  |||   |       |/-++-+++--+\|  |   |   |  |   |  | |    |           | |  | |  || ||||| | ||     |   |  |
 ||   |  | |  |     |  |  |  |      | || ||    |||   |       \+-++-+++--+++--/   |   |  |   |  | |    |           | |  | |  || ||||| | ||     |   |  |
 v|   |  | |  \-----+--+--+--+------+-++-++----+++---+--------+-++-+++--+++------/   |  |   |  | |  /-+-----------+-+--+-+--++-+++++\| ||     |   |  |
 |\---+--+-+--------+--+--/  |      | || ||    |||   |        | || |||  |||          |  |   |  | \--+-+-----------+-+--+-+--++-+++++++-+/     |   |  |
 |    |  | |        |  |     |      | || ||    |||   |        | || |||  |||          |  |   |  |    | |   /-------+-+--+-+--++-+++++++-+------+-\ |  |
 |    |  | |        |  |     |      | |\-++----+++---+--------+-++-+++--+++----------+--+---+--+----+-+---+-------+-+--+-+--++-+/||||| |      | | |  |
 |    \--+-+--------+--/     |      | \--++----+/|   |        | || ||\--+++------<---+--+---+--+----+-+-<-+-------+-+--+-+--/| | ||||| |      | | |  |
 |       | |   /----+-----\  |      |    \+----+-+---+--------+-++-++---+++----------+--+---+--+----+-+---+-------+-+--+-+---+-+-+/||| |      | | |  |
 |       | |   |    |     |  |      |     |    | |   |        | || \+---+++----------+--+---+--+----+-+---+-------+-/  | |   | | | ||| |      | | |  |
 |       | |   |    |     |  |      \-----+----+-+---+--------+-++--+---+++----------+--+---/  \----+-+---+-------+----+-+---+-+-/ ||| |      | | |  |
 |       | |   |    |     |  |            |    | |   |        | |\--+---+++----------+--+-----------+-+---+-------+----+-+---+-/   ||| |      | | |  |
 |       | |   |    |     |  |            |    | \---+--------+-+---+---+++----------+--+-----------+-+---+-------/    | |   |     ||| |      | | |  |
 |/------+-+---+----+-----+--+------------+----+-----+--------+-+---+---+++----------+--+------\    \-+---+------------+-+---+-----+/| |      | | |  |
 ||      | |   |    \-----+--+------------+----+-----+--------+-+---/   |||          | /+------+------+---+------------+-+---+-----+-+-+------+-+\|  |
 ||      | |   |    /-----+--+------------+----+-----+--------+-+-------+++----------+-++------+------+---+------\     | |   \-----+-+-/      | |||  |
 ||      | |   |    |     |  |            \----+-----+--------+-+-------+++----------+-++------+------+---+------+-----+-+---------+-+--------/ |||  |
 ||      | |   |    |     |  |                 |     |        | |       |||          \-++------+------+-->+------+-----+-/         | |          |||  |
 \+------+-+---+----+-----+--+-----------------+-----+--------+-+-------/||            ||      |      |   |      |     |           | |          |||  |
  |      \-+---+----+-----+--+-----------------+-----+--------+-+--------++------------++------+------/   |      |     |           | |          |||  |
  |        |   |    |     |  |                 |     |        | |        ||            ||      |          |      |     |           | |          |||  |
  |        |   \----+-----/  \-----------------/     |        | |        ||            ||      |          |      |     |           | |          |||  |
  |        |        |                                |        | |        ||            ||      |          |      |     |           | |          |||  |
  |        |        |                                \--------+-+--------++------------++------+----------+------+-----+-----------+-/          |||  |
  |        |        |                                         | |        |\------------++------+----------+------+-----+-----------+------------+++--/
  |        |        |                                         | |        |             ||      |          |      |     |           \------------++/   
  |        |        |                                         | |        |             ||      |          |      |     |                        ||    
  |        \--------+-----------------------------------------+-+--------+-------------+/      |          \------+-----+------------------------/|    
  |                 |                                         | \--------+-------------+-------+-----------------+-----/                         |    
  \-----------------+-----------------------------------------+----------+-------------+-------/                 |                               |    
                    \-----------------------------------------+----------+-------------+-------------------------/                               |    
                                                              \----------/             \---------------------------------------------------------/    ';
    }
}
