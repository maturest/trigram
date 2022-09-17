<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait AccTrait
{
    public function getAcc($god)
    {
        if ($god == '财') {
            //子爻的五行颜色
            $color_wx = $this->getWxBySixQin('子');
            //财爻的五行物件
            $goods_wx = $this->getWxBySixQin('财');

            return $this->getAccLetters($color_wx, $goods_wx);
        }

        //用神的五行颜色
        $color_wx = $this->getWxByGod($god);
        //生用神的五行物件
        $goods_wx = $this->getGrowMeWxs($color_wx);

        return $this->getAccLetters($color_wx, $goods_wx);
    }

    public function getAccLetters($color_wx, $goods_wx)
    {
        $colors = [
            ['wx' => '木', 'color' => '绿色或紫色'],
            ['wx' => '火', 'color' => '红色'],
            ['wx' => '土', 'color' => '黄色'],
            ['wx' => '金', 'color' => '白色'],
            ['wx' => '水', 'color' => '黑色或蓝色'],
        ];

        $goods = [
            ['wx' => '木', 'good' => '3颗绿色珠子'],
            ['wx' => '火', 'good' => '7颗红色珠子（或7公分档煞宝）'],
            ['wx' => '土', 'good' => '5颗黄色珠子'],
            ['wx' => '金', 'good' => '9颗白色珠子（或9枚硬币/铜钱）'],
            ['wx' => '水', 'good' => '1颗黑色珠子'],
        ];

        $color = collect($colors)->where('wx', $color_wx[0])->first();

        $good = collect($goods)->where('wx', $goods_wx[0])->first();

        $string = '?锦囊内放?，建议您随身携带。';

        return Str::replaceArray('?', [$color['color'], $good['good']], $string);
    }
}