<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day6;

class OrbitCounter
{
    public function count(ObjectInSpace $centerOfMass): int
    {
        if ($centerOfMass->getOrbits()) {
            throw new \InvalidArgumentException('Input is not a COM!');
        }

        return $this->visit($centerOfMass, 0);
    }

    public function findSanta(ObjectInSpace $start, int $previousTransfers = 0): int
    {
        $transfersNeeded = $previousTransfers;
        $minTransfers = PHP_INT_MAX;
        $start->setVisited();

        foreach ($start->getOrbitants() as $orbitant) {
            if ($orbitant->isVisited()) {
                continue;
            }

            if ($orbitant->isSanta()) {
                return $transfersNeeded;
            }

            $minTransfers = min($minTransfers, $this->findSanta($orbitant, $transfersNeeded + 1));
        }

        $objectInSpace = $start->getOrbits();
        if ($objectInSpace) {
            if ($objectInSpace->isVisited()) {
                return $minTransfers;
            }

            if ($objectInSpace->isSanta()) {
                return $transfersNeeded + 1;
            }

            $minTransfers = min($minTransfers, $this->findSanta($objectInSpace, $transfersNeeded + 1));
        }

        return $minTransfers;
    }

    private function visit(ObjectInSpace $centerOfMass, int $startWith): int
    {
        $count = $startWith;

        foreach ($centerOfMass->getOrbitants() as $orbitant) {
            $count += $this->visit($orbitant, $startWith + 1);
        }

        return $count;
    }
}
