<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2019\Day6;

class OrbitGraphFactory
{
    public static function create(string $input, string $return = 'COM'): ObjectInSpace
    {
        $objectMap = [];
        $instructionList = explode(PHP_EOL, $input);

        foreach ($instructionList as $instruction) {
            [$name1, $name2] = explode(')', $instruction);
            $object1 = self::getObject($objectMap, $name1);
            $object2 = self::getObject($objectMap, $name2);

            $object1->addOrbitant($object2);
        }

        return $objectMap[$return];
    }

    private static function getObject(array &$objectMap, $name): ObjectInSpace
    {
        if (! isset($objectMap[$name])) {
            $objectMap[$name] = new ObjectInSpace($name);
        }

        return $objectMap[$name];
    }
}
