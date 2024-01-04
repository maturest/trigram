<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait AccTrait
{
    /**
     * > Get the letters of the god's acc
     *
     * @param god the god you want to calculate
     *
     * @return The return value is an array of letters.
     */
    public function acc($god)
    {
        if ($god == '财') {
            $zi_positions = $this->getGodPositionsWithSixQin('子');
            $color_wx = $zi_positions[0]['wx'];

            $cai_positions = $this->getGodPositionsWithSixQin('财');
            $goods_wx = $cai_positions[0]['wx'];

            return $this->getAccLetters($color_wx, $goods_wx);
        }

        $color_wx = $this->getGodWx();

        $goods_wx = $this->getWhoGrowMe($color_wx);

        return $this->getAccLetters($color_wx, $goods_wx);
    }

    /**
     * It takes two parameters, `` and ``, and returns a string with the color and
     * good substituted in
     *
     * @param color_wx The color of the five elements of the year
     * @param goods_wx the wuxing of the goods
     *
     * @return string
     */
    public function getAccLetters($color_wx, $goods_wx)
    {
        $colors = [
            ['wx' => '木', 'color' => '绿色或紫色'],
            ['wx' => '火', 'color' => '红色'],
            ['wx' => '土', 'color' => '黄色'],
            ['wx' => '金', 'color' => '白色'],
            ['wx' => '水', 'color' => '蓝色'],
        ];

        $goods = [
            ['wx' => '木', 'good' => '3颗绿色珠子'],
            ['wx' => '火', 'good' => '7颗红色珠子（或7公分挡煞宝）'],
            ['wx' => '土', 'good' => '5颗黄色珠子'],
            ['wx' => '金', 'good' => '9颗白色珠子（或9枚硬币）'],
            ['wx' => '水', 'good' => '1颗黑色珠子'],
        ];

        $color = collect($colors)->where('wx', $color_wx)->first();

        $good = collect($goods)->where('wx', $goods_wx)->first();

        $string = '?锦囊内放?，建议您随身携带。';

        return Str::replaceArray('?', [$color['color'], $good['good']], $string);
    }
}
