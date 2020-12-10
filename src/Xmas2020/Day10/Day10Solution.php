<?php

declare(strict_types=1);

namespace Jean85\AdventOfCode\Xmas2020\Day10;

use Jean85\AdventOfCode\SolutionInterface;

class Day10Solution implements SolutionInterface
{
    public function solve(string $input = null)
    {
        $adapters = [];
        foreach (explode("\n", $input ?? $this->getInput()) as $adapter) {
            $adapters[] = (int)$adapter;
        }

        sort($adapters);
        $adapters[] = max($adapters) + 3;

        $jumpOf1 = 0;
        $jumpOf3 = 0;
        $previousAdapter = 0;

        foreach ($adapters as $adapter) {
            switch ($adapter - $previousAdapter) {
                case 3:
                    $jumpOf3++;
                    break;
                case 1:
                    $jumpOf1++;
                    break;
            }

            $previousAdapter = $adapter;
        }

        var_dump($jumpOf1, $jumpOf3);

        return $jumpOf1 * $jumpOf3;
    }

    private function getInput(): string
    {
        return '111
56
160
128
25
182
131
174
87
52
23
30
93
157
36
155
183
167
130
50
71
98
42
129
18
13
99
146
81
184
1
51
137
8
9
43
115
121
171
77
97
149
83
89
2
38
139
152
29
180
10
165
114
75
82
104
108
156
96
150
105
44
100
69
72
143
32
172
84
161
118
47
17
177
7
61
4
103
66
76
138
53
88
122
22
123
37
90
134
41
64
127
166
173
168
58
26
24
33
151
57
181
31
124
140
3
19
16
80
164
70
65';
    }
}
