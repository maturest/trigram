<?php


namespace Maturest\Trigram\Traits\GodNums;


trait Gram
{
    private $gram = [
        1 => [6, 7],
        2 => [6, 7],
        3 => [1, 2, 12],
        4 => [3, 8, 9],
        5 => [3, 8, 9],
        6 => [10, 11],
        7 => [10, 11],
        8 => [1, 2, 12],
        9 => [1, 2, 12],
        10 => [4, 5],
        11 => [4, 5],
        12 => [6, 7],
    ];

    private $absolute = [
        [2, 6],
        [7, 12],
        [7, 11],
        [4, 10],
        [3, 5],
        [1, 8],
        [1, 9],
    ];

    protected function getGramRelation($frontNums, $new_front_nums, $laterNums, $new_later_nums)
    {
        $front_gram = $this->gramRelation($frontNums, $new_front_nums);
        $later_gram = $this->gramRelation($laterNums, $new_later_nums);
        $gram_statistics = array_merge($front_gram['gram_statistics'], $later_gram['gram_statistics']);
        $gram_statistics = $this->gramStatistics($gram_statistics);

        return [
            'front_gram_relation' => $front_gram['gram_relations'],
            'later_gram_relation' => $later_gram['gram_relations'],
            'gram_statistics' => $gram_statistics,
        ];
    }

    protected function gramRelation($nums, $new_nums)
    {
        $gram_relations = [];
        $gram_statistics = [];
        $max_key = count($new_nums) - 1;
        $last_position = '';
        foreach ($new_nums as $key => $num) {

            if ($key == $max_key) {
                $gram_relations[] = $last_position ?: '';
                break;
            }

            $a = $key == 0 ? last($nums) : $new_nums[$key - 1];
            $b = $new_nums[$key + 1];

            if ($a == '') {
                $gram_relations[] = '';
                continue;
            }

            // a 克 b
            if (in_array($b, $this->gram[$a])) {
                $gram_statistics[] = [
                    'relation' => $this->wxs[$a] . '克' . $this->wxs[$b],
                    'nums' => [$a, $b],
                    'join' => $a . '-' . $b,
                    'is_absolute' => $this->isAbsolute($a, $b),
                ];
                $gram_relations[] = 'right';
            } else if (in_array($a, $this->gram[$b])) {
                // b 克 a
                $gram_statistics[] = [
                    'relation' => $this->wxs[$b] . '克' . $this->wxs[$a],
                    'nums' => [$b, $a],
                    'join' => $b . '-' . $a,
                    'is_absolute' => $this->isAbsolute($b, $a),
                ];

                if ($key == 0) {
                    $gram_relations[] = '';
                    $last_position = 'left';
                } else {
                    $gram_relations[] = 'left';
                }
            } else {
                // a 与 b 不存在生的关系
                $gram_relations[] = '';
            }
        }

        return compact('gram_relations', 'gram_statistics');
    }

    protected function isAbsolute($a, $b)
    {
        if (in_array([$a, $b], $this->absolute) || in_array([$b, $a], $this->absolute)) {
            return true;
        }

        return false;
    }

    protected function gramStatistics($gram_statistics)
    {
        $grouped = collect($gram_statistics)->groupBy('join')->toArray();
        $res = [];
        foreach ($grouped as $key => $group) {
            $res[] = [
                'relation' => $group[0]['relation'],
                'god_num' => $key,
                'count' => count($group),
                'is_absolute' => $group[0]['is_absolute'],
            ];
        }

        return $res;
    }
}