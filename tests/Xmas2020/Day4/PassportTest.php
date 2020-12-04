<?php

declare(strict_types=1);

namespace Tests\Xmas2020\Day4;

use Jean85\AdventOfCode\Xmas2020\Day4\InputParser;
use Jean85\AdventOfCode\Xmas2020\Day4\Passport;
use Jean85\AdventOfCode\Xmas2020\Day4\PassportFactory;
use PHPUnit\Framework\TestCase;

class PassportTest extends TestCase
{
    public function testValidation(): void
    {
        $passport = new Passport($this->getValidData());

        $this->assertTrue($passport->hasValidData());
    }

    /**
     * @dataProvider validPassportDataProvider
     */
    public function testValidData(string $field, string $validData): void
    {
        $data = $this->getValidData();
        $data[$field] = $validData;
        $passport = new Passport($data);

        $this->assertTrue($passport->hasValidData());
    }

    public function validPassportDataProvider(): array
    {
        return [
            ['byr', '2002'],
            ['hgt', '60in'],
            ['hgt', '190cm'],
            ['hcl', '#123abc'],
            ['ecl', 'brn'],
            ['pid', '000000001'],
        ];
    }

    /**
     * @dataProvider invalidPassportFieldDataProvider
     */
    public function testInvalidFieldData(string $field, string $invalidData): void
    {
        $data = $this->getValidData();
        $data[$field] = $invalidData;
        $passport = new Passport($data);

        $this->assertFalse($passport->hasValidData());
    }

    public function invalidPassportFieldDataProvider(): array
    {
        return [
            ['byr', '2003'],
            ['hgt', '190in'],
            ['hgt', '190'],
            ['hcl', '#123abz'],
            ['hcl', '123abc'],
            ['ecl', 'wat'],
            ['pid', '0123456789'],
        ];
    }

    /**
     * @dataProvider invalidPassportProvider
     */
    public function testInvalidData(Passport $invalidPassport): void
    {
        $this->assertFalse($invalidPassport->hasValidData(), 'Should be invalid!');
    }

    /**
     * @return \Generator<Passport>
     */
    public function invalidPassportProvider(): \Generator
    {
        $input = 'eyr:1972 cid:100
hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926

iyr:2019
hcl:#602927 eyr:1967 hgt:170cm
ecl:grn pid:012533040 byr:1946

hcl:dab227 iyr:2012
ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277

hgt:59cm ecl:zzz
eyr:2038 hcl:74454a iyr:2023
pid:3556412378 byr:2007';

        $factory = new PassportFactory(new InputParser());

        foreach ($factory->create($input) as $passport) {
            yield [$passport];
        }
    }

    private function getValidData(): array
    {
        return [
            'ecl' => 'gry',
            'pid' => '860033327',
            'eyr' => '2020',
            'hcl' => '#fffffd',
            'byr' => '1937',
            'iyr' => '2017',
            'cid' => '147',
            'hgt' => '183cm',
        ];
    }
}
