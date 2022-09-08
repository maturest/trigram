<?php


namespace Maturest\Trigram\Traits\GodNums;


trait Raw
{
    // 生
    private $raw = [
        1 => [4, 5],
        2 => [4, 5],
        3 => [10, 11],
        4 => [6, 7],
        5 => [6, 7],
        6 => [3, 8, 9],
        7 => [3, 8, 9],
        8 => [10, 11],
        9 => [10, 11],
        10 => [1, 2, 12],
        11 => [1, 2, 12],
        12 => [4, 5],
    ];

    public function getRawRelation($frontNums, $new_front_nums, $laterNums, $new_later_nums)
    {
        $front_raw_relation = $this->rawRelation($frontNums, $new_front_nums);
        $later_raw_relation = $this->rawRelation($laterNums, $new_later_nums);
        return compact('front_raw_relation', 'later_raw_relation');
    }

    protected function rawRelation($nums, $new_nums)
    {
        // 生关系
        $raw_relations = [];

        $max_key = count($new_nums) - 1;
        $last_position = '';
        foreach ($new_nums as $key => $num) {

            if ($key == $max_key) {
                $raw_relations[] = $last_position ?: '';
                break;
            }

            $a = $key == 0 ? last($nums) : $new_nums[$key - 1];
            $b = $new_nums[$key + 1];

            if ($a == '') {
                $raw_relations[] = '';
                continue;
            }

            // a 生 b
            if (in_array($b, $this->raw[$a])) {
                $raw_relations[] = 'right';
            } else if (in_array($a, $this->raw[$b])) {
                // b 生 a
                if ($key == 0) {
                    $raw_relations[] = '';
                    $last_position = 'left';
                } else {
                    $raw_relations[] = 'left';
                }
            } else {
                // a 与 b 不存在生的关系
                $raw_relations[] = '';
            }
        }

        return $raw_relations;
    }
}