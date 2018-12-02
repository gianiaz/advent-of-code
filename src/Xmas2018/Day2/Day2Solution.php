<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2018\Day2;

use Jean85\AdventOfCode\SecondPartSolutionInterface;
use Jean85\AdventOfCode\SolutionInterface;

class Day2Solution implements SolutionInterface, SecondPartSolutionInterface
{
    private const INPUT = 'dghfbsyiznoumojleevappwqtr dghfbsyiznoumkjljevacpmqer dghfbbyizioumkjlxevacpwdtr dghfbsesznoumkjlxevacpwqkr dghfbsynznoumkjlxziacpwqtr cghfbsyiznjumkjlxevacprqtr dghfjsyizwoumkjlxevactwqtr dghfdsyfinoumkjlxevacpwqtr hghfbsyiznoumkjlxivacpwqtj dgcfbsyiznoumkjlxevacbuqtr dghfbsyiznoymnjlxevacpwvtr dfhfbsyiznoumkulxevacptqtr dghfasyiznovmkjlxevacpwqnr dghfbsyihnouikjlxevackwqtr dghfbayiznolmkjlyevacpwqtr jghfbsyiznoumnjldevacpwqtr dhhfbsyuznoumkjlxevakpwqtr nehfrsyiznoumkjlxevacpwqtr dghfbsyiznxdmkolxevacpwqtr dgpfbsyizwlumkjlxevacpwqtr yghfbsyiznoumkjlsevacpwqtm dghfssyiznoumkjlxevvcpwqjr dahfbsyiznoumkjlfevacpwqto duhfcsyiznouvkjlxevacpwqtr dghfbvyiznoumkjlrevacpwvtr dghfgsyiznoumknlxgvacpwqtr jghfbeyiznkumkjlxevacpwqtr daofbsyiznoumkjlxevampwqtr dghfbsyiznojmkjlxeracpcqtr dghnbsyiznouokjlxevaclwqtr dgifbsyiznoumkjlxevnspwqtr dgkfpsziznoumkjlxevacpwqtr dghfxsyijnoumkjlxevaccwqtr dghfbsyiznolmkjlwevzcpwqtr dkhfbsaiznoumkjlxevacpwqtg dghfbsygknoumkjlaevacpwqtr dghfbsyizizumkjlxevacpxqtr ighfbbyijnoumxjlxevacpwqtr dghfbsyizrouekjlxevacpwktr dghobsyiznoujkjlxevacnwqtr dghpbsyizyoumkjlxeaacpwqtr dghffsyiznoymkjlxevacewqtr dghkbssiznoumzjlxevacpwqtr dghfbsyawnoumkjlxevacpwjtr drhfbsyiznormkjlfevacpwqtr dghfbsoiznouwkjlxevacpwqtn dghfmsyiznoumkjlxlvecpwqtr dxhfbsyiznoumkjlxeeacvwqtr dghnbsyiznoumkjsxevacpwqur dghfbsyiznrujkjlxevacpwqtc dghfbstoznoumhjlxevacpwqtr dghfboyiznzumkjlvevacpwqtr dghfbsyiznjumkjlxevgcpwmtr dghfbsnizaoumkjlxevacpwetr dghfbsyirnoumkjoxevacplqtr dghfbsyiznoumkjlxavvckwqtr dghfbjdiznoumkjlxevacpwptr dghfbsywznoumkjlxeiacpwqcr djhfbsyizuoumkjlxelacpwqtr dghffsniznoumkjlxpvacpwqtr dghebsyizuoumkjlxevecpwqtr rghfbsyiznourkjcxevacpwqtr dghfbsyignoumkwlxenacpwqtr dghfbsyiznrufkjlxevacpwqth dgifbsyiznoumkjlxevacpjqnr dghfbsyiznoumkjbxevaxpwqtw dsufbsyizncumkjlxevacpwqtr dihfbsyiznoumujlxecacpwqtr dghfbiyiznoumkjlxevajpwqtn dghqbsyixnoumkjlrevacpwqtr dghfbsyiznouukjlxeuacpwqtx dghfbsyizyoumksfxevacpwqtr dghfbsiiznopfkjlxevacpwqtr eghfbsyidnoumkjlxexacpwqtr dghfbgyiznouwkjlwevacpwqtr dghfbsyyznoumkjlxevacwwqtf bghfbtypznoumkjlxevacpwqtr dghfbsyiznoumtjlxebacpwetr dghfbsgiznonmkplxevacpwqtr dghfbsyiznoumxjlxevanpwqpr dghfbsyiznwumujuxevacpwqtr dghxbsyiznoumkjzxevaypwqtr dghfbsyhznoumkjlxlvacpiqtr dghfbsyiznoumkjlxevzcnwqrr dvhfbsyiznoumkjluevacpzqtr dghcbsyiznoumkjlxmvacpwetr dghfbsyiznohmkjvxbvacpwqtr dghfzsyiznouokjlxevacpwqpr dghfbsyiznoumkjlxevachtqth dghfbsyiznoumkjlxjvacpfutr dghfbsyiznoumkjlxevsppwqtt dghfusyiznouakhlxevacpwqtr dghfbsyizcoumkjlxrvaipwqtr dghebsyipnoumfjlxevacpwqtr dgdfbsyiznoumkjlwevacpkqtr dghfbsyiznoumkjlcffacpwqtr dghfbsypznfumkjlxevacpwqar dghfbsyiznojmkjlxevgcpkqtr dghfbsyiznoumkjlaevlcpwstr dgafrsyiunoumkjlxevacpwqtr dghfbsyiznouqljlxevacrwqtr dyhkbsyiznokmkjlxevacpwqtr pghfbsciznoumkjlxevacpwvtr dghfbxyiznonmkjllevacpwqtr ighfbsyizxoumkjlxevacpzqtr dgffbsyoznoumkjlxevacpwqto hghfbsyiznoumkjlpevachwqtr dlhfosyiznoumkjldevacpwqtr dghfbsvizkoumkjlxvvacpwqtr dbafbsyiznozmkjlxevacpwqtr dghfbsyidnoumkjlxrvjcpwqtr dghfbsyiznfumkjlxeqacpwqta dghfbsfiznoumkjvxevacjwqtr dghfbsyimnoumrjlhevacpwqtr dghflsyiznoumkjlxevacpvqmr dghfbmfiznoumkjlxevacpdqtr dghfbsyizsouzkjlxevscpwqtr dghfksyiznoumimlxevacpwqtr dghfbsyiznoumkjlxevbwpwqur wghcbsyiznoumkjlkevacpwqtr kghfbioiznoumkjlxevacpwqtr dghfbsiizeoumkjlxmvacpwqtr dglfbsyilnoumkjlxevpcpwqtr dgqfbsylznoumkjlxevacpwqcr dglfhsyiznoumkjlxevacpwqdr dghfbsymznoumkjlxbvacpwqtb hghfbsyizhoumkjlxtvacpwqtr dghdbsyiznoumkjlxeiacpyqtr dohfbsyiznoumkjmxlvacpwqtr xhhfbsyiznoumkjlxegacpwqtr dlhfbsyiznoumkjlxnvahpwqtr dghfbsyiznovdpjlxevacpwqtr dgcfbsyiznoumkjlxevactwqdr dghfksyiknoumkjlxevacpwqcr ughfqsyiznoumkjlxevacpwctr dghfbjyiznoumkjlxsvacnwqtr dgwfbagiznoumkjlxevacpwqtr dghfbsyiznoumknlxevtcpwqdr jghfksyiznoumkjlxeoacpwqtr dghfbsyiznoimkjlwezacpwqtr dghfbsyiunoumkjlxeqacpwstr dghfbsyizjoumkwlxevaypwqtr dghfysriznoumkjlxevucpwqtr dghfbsygzjoumkjfxevacpwqtr dghfbhviznoumkjlxevacpwqtq dghfbsyiznoumkjvwevacpwqur dghfbsyiznoumtjlxevacplqnr yghfbsysznouykjlxevacpwqtr dgwfbsiiznoumkjlxevacfwqtr dghfbsyizooumkjlxevampiqtr dshfbsyiznoumkjlxevawpoqtr dghtbsyxznuumkjlxevacpwqtr dkhfblyiznoumkjlxevacpaqtr dgkfbsyiinoumkjlxegacpwqtr dghfbtxiznouhkjlxevacpwqtr dghfbsyiznoumkjlxkvmcpeqtr dghfbsyiznoumkjlghvacpwqmr dghfbsbizioumkjlcevacpwqtr dphfbsyizhoumkjwxevacpwqtr dghfbsyiznqumkjlugvacpwqtr dghfbsjinnoumkjlxevacpwetr mghfbsyiznoumkjlxfvacpjqtr dghfbsxiznoumkjlxetacwwqtr dghmbsyiznoumbjlxevacpwqyr dghfbsyiznwumkjlwevacmwqtr dgkfbsyiznotmkjlxevacpwstr dghfbsyiznouykjlxeiacuwqtr dghfbsynznbhmkjlxevacpwqtr dgyfbsyiznoumtjlbevacpwqtr dghfbftiznoumkjlxevacpwatr dghfvsyiznouikjlievacpwqtr dghfbsyiznodmkjlxevncpwqtz yfhfbsyiznoumkjluevacpwqtr dghfbzyiznoumhflxevacpwqtr dphfbsyizncumkjlxevacpwqtf dghfasyiznoumkjlxeaicpwqtr dgffbsyiznoumkjlzevacpwqsr dghfbsyiznoumkmxxcvacpwqtr dghffsyiznoumkjlxevacpwqre dghfbsyizndmmkjlxemacpwqtr dghfbsviznoamkjlxevappwqtr dghfbsyiznouckrlxevacpdqtr dgwfbsyiznyumkjlxevacpqqtr dujfbsyiznoumgjlxevacpwqtr dghobsailnoumkjlxevacpwqtr dghfkqyiznoumknlxevacpwqtr dghfbyypznoumkjlxevacpwatr wqhfbsyiznoumkjlxevzcpwqtr dghfbsyiznoumwjlxrvacppqtr dghfbsymznoumkflxevacplqtr dghfbsyiznounkjpgevacpwqtr ighfbsyijnoumxjlxevacpwqtr dghfbsyizroumkjllevncpwqtr dghfbsliznokmkjlxevacpwqtb dgefbsyiznoumkqlxevpcpwqtr dghfbtypznouzkjlxevacpwqtr dmhfbsyiznoumkjlxeyactwqtr vohfbsyiznoumkjlqevacpwqtr dgsfpsyiznodmkjlxevacpwqtr dghfzsyijnoumkjnxevacpwqtr dghfbayijroumkjlxevacpwqtr dghfbsyiznodmxjlxgvacpwqtr dghfbsyiznocmkjlxhvaipwqtr dghmbsyignoumkjlxevacpoqtr dghfbsyiznosmkjlncvacpwqtr dggfbsyiznuumkjlxevacpwqrr dghibsyilnoumkjlxevacowqtr dghfbsyiznoumkjluevbcowqtr dghfbsaiznyuvkjlxevacpwqtr dgnfxsyiznommkjlxevacpwqtr dghfbnyiznoumkjlsnvacpwqtr dghfssiiznoumkjlxavacpwqtr dghfbsyizneumajlxevacfwqtr dghfbsyiznoumkjlxevycpvptr qghfbsyizgoumkjlxevacpwttr vghfbsyiznoumkjlievaepwqtr dghfbsyiznoumejlxjvacpwdtr dghfbsyispoumkjlxevacpwqtg duhfbsyizpoumkjlxenacpwqtr dghfbsyifnoumkblxevacpnqtr bghfbsyxznoumkjleevacpwqtr dgtfbsyzpnoumkjlxevacpwqtr dghfbsyiznoumkjlsecacpwqth dghfqsyiznjumkjlxevawpwqtr dgcfbsyizboumkjlxevacqwqtr dghfbqyiznoumkjkxevacpwqtj dgyfbsyfznoumkjlievacpwqtr dghfdsyiznoumkplxevacpwdtr dphfbsyuznkumkjlxevacpwqtr dghfbsyiznoupkjitevacpwqtr dghfisyiznoamkjlxevacpwqwr dgufbsyiznoumkjlxivvcpwqtr dghfbvyiznoumkjlxevacvwqtz dghfbsyiqnxumkjlxbvacpwqtr dghubsyiznqumkflxevacpwqtr dghfbsyiznzumkjlxevacpdbtr dghfbsyiznoumkjlxehacpwwrr mghfbsyiznoumkjlxevacpwqbp dvhfbryiznoumkclxevacpwqtr dghbbsyiznotmkjlxevacpwqhr dghfrsyiznoomkjlxevacpwqto dghfbkyiznoumkjlxeracpxqtr dghfbfyizfoumkjlxevacpwjtr dghfbsyizqoulkjlxevacpwqtt dghfbsyiwnoumkjlxevacxwgtr dghfbsyiznormkjlgxvacpwqtr dghybsyizioumkjoxevacpwqtr dchfbsyiznoumkjlxyvacpwqtc dgyfbsyiznouckjlxewacpwqtr dakfbsyeznoumkjlxevacpwqtr';

    /** @var BoxId[] */
    private $ids;

    /**
     * Day2Solution constructor.
     */
    public function __construct(string $input = self::INPUT)
    {
        foreach (explode(' ', $input) as $id) {
            $this->ids[] = new BoxId($id);
        }
    }

    public function solve(): int
    {
        $countedTwice = 0;
        $countedThrice = 0;

        foreach ($this->ids as $id) {
            if ($id->isCountedTwice()) {
                ++$countedTwice;
            }

            if ($id->isCountedThrice()) {
                ++$countedThrice;
            }
        }

        return $countedTwice * $countedThrice;
    }

    public function solveSecondPart(): string
    {
        $counterPart = $this->ids;
        foreach ($this->ids as $boxId) {
            foreach ($counterPart as $otherBoxId) {
                if ($boxId->isSimilarTo($otherBoxId)) {
                    return $boxId->getId() . PHP_EOL . $otherBoxId->getId();
                }
            }
        }

        throw new \RuntimeException('Solution not found');
    }
}
