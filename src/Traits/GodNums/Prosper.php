<?php


namespace Maturest\Trigram\Traits\GodNums;


trait Prosper
{
    private $prosper = [
        1 => [1, 2, 12],
        2 => [1, 2, 12],
        3 => [3, 8, 9],
        4 => [4, 5],
        5 => [4, 5],
        6 => [6, 7],
        7 => [6, 7],
        8 => [3, 8, 9],
        9 => [3, 8, 9],
        10 => [10, 11],
        11 => [10, 11],
        12 => [1, 2, 12],
    ];

    protected function getProsperRelation($frontNums, $new_front_nums, $laterNums, $new_later_nums)
    {
        $front_prosper_relation = $this->properRelation($frontNums, $new_front_nums);
        $later_prosper_relation = $this->properRelation($laterNums, $new_later_nums);
        return compact('front_prosper_relation', 'later_prosper_relation');
    }

    protected function properRelation($nums, $new_nums)
    {
        $proper_relations = [];

        $max_key = count($new_nums) - 1;
        $last_position = '';
        foreach ($new_nums as $key => $num) {

            if ($key == $max_key) {
                $proper_relations[] = $last_position ?: '';
                break;
            }

            $a = $key == 0 ? last($nums) : $new_nums[$key - 1];
            $b = $new_nums[$key + 1];

            if ($a == '') {
                $proper_relations[] = '';
                continue;
            }

            // a 比旺 b
            if (in_array($b, $this->prosper[$a])) {
                $proper_relations[] = 'right';
            } else if (in_array($a, $this->prosper[$b])) {
                // b 比旺 a
                if ($key == 0) {
                    $proper_relations[] = '';
                    $last_position = 'left';
                } else {
                    $proper_relations[] = 'left';
                }
            } else {
                // a 与 b 不存在比旺的关系
                $proper_relations[] = '';
            }
        }

        return $proper_relations;
    }
}