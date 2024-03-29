<?php


namespace Maturest\Trigram\Traits\GodNums;


trait YinYang
{
    protected $lunar = [
        5, 6, 7, 8, 9, 10
    ];

    protected $solar = [
        1, 2, 3, 4, 11, 12
    ];

    protected function getYinYangRelation($front_nums, $later_nums)
    {
        $front_lunar_solar = $this->getYinYang($front_nums);
        $later_lunar_solar = $this->getYinYang($later_nums);

        return compact('front_lunar_solar', 'later_lunar_solar');
    }

    protected function getYinYang($nums)
    {
        $res = [];
        foreach ($nums as $num) {
            if ($num) {
                $res[] = in_array($num, $this->lunar) ? 'lunar' : 'solar';
            } else {
                $res[] = '';
            }
        }

        return $res;
    }

}