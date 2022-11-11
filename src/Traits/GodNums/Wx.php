<?php


namespace Maturest\Trigram\Traits\GodNums;


trait Wx
{
    protected $wxs = [
        1 => '水', 2 => '水', 3 => '土',
        4 => '木', 5 => '木', 6 => '火',
        7 => '火', 8 => '土', 9 => '土',
        10 => '金', 11 => '金', 12 => '水',
    ];

    protected function getWxByNums($front_nums, $later_nums)
    {
        $front_wx = $this->wx($front_nums);
        $later_wx = $this->wx($later_nums);
        return compact('front_wx', 'later_wx');
    }

    protected function wx($nums)
    {
        $wx = [];
        foreach ($nums as $num) {
            if ($num) {
                $wx[] = $this->wxs[$num];
            } else {
                $wx[] = '';
            }
        }

        return $wx;
    }
}