<?php

namespace Maturest\Trigram\Traits\TwelveGodNums;

use Illuminate\Support\Str;

trait BigSuccessScene
{
    protected $drawSuccess = [
        'four_purple_red' => ['pearl_num' => '4', 'pearl_color' => '紫色', 'plate_color' => '红色'],
        'four_purple_blue' => ['pearl_num' => '4', 'pearl_color' => '紫色', 'plate_color' => '蓝色'],
        'eight_yellow_black' => ['pearl_num' => '8', 'pearl_color' => '黄色', 'plate_color' => '黑色'],
        'eight_yellow_red' => ['pearl_num' => '8', 'pearl_color' => '黄色', 'plate_color' => '红色'],
        'two_blue_purple' => ['pearl_num' => '2', 'pearl_color' => '蓝色', 'plate_color' => '紫色'],
        'twelve_brown_black' => ['pearl_num' => '12', 'pearl_color' => '咖啡色', 'plate_color' => '黑色'],
        'two_blue_green' => ['pearl_num' => '2', 'pearl_color' => '蓝色', 'plate_color' => '绿色'],
        'six_red_yellow' => ['pearl_num' => '6', 'pearl_color' => '红色', 'plate_color' => '黄色'],
        'seven_red_green' => ['pearl_num' => '7', 'pearl_color' => '红色', 'plate_color' => '绿色'],
        'eleven_black_brown' => ['pearl_num' => '11', 'pearl_color' => '黑色', 'plate_color' => '咖啡色'],
        'eleven_black_yellow' => ['pearl_num' => '11', 'pearl_color' => '黑色', 'plate_color' => '黄色'],
        'ten_black_yellow' => ['pearl_num' => '10', 'pearl_color' => '黑色', 'plate_color' => '黄色'],
        'eleven_black_blue' => ['pearl_num' => '11', 'pearl_color' => '黑色', 'plate_color' => '蓝色'],
        'five_green_blue' => ['pearl_num' => '5', 'pearl_color' => '绿色', 'plate_color' => '蓝色'],
        'five_green_red' => ['pearl_num' => '5', 'pearl_color' => '绿色', 'plate_color' => '红色'],
        'ten_black_brown' => ['pearl_num' => '10', 'pearl_color' => '黑色', 'plate_color' => '咖啡色'],
        'ten_black_blue' => ['pearl_num' => '10', 'pearl_color' => '黑色', 'plate_color' => '蓝色'],
    ];


    // 大成局  大成局存在男女之分
    protected $bigSuccessScenes = [
        ['num' => '1-6', 'sex' => 1, 'orientation' => '东南偏南方', 'draw_key' => 'four_purple_red','sort'=>20],
        ['num' => '2-6', 'sex' => 1, 'orientation' => '东南偏南方', 'draw_key' => 'four_purple_red','sort'=>20],
        ['num' => '2-6', 'sex' => 1, 'orientation' => '东北偏北方', 'draw_key' => 'four_purple_blue','sort'=>20],
        ['num' => '12-6', 'sex' => 1, 'orientation' => '东南偏南方', 'draw_key' => 'four_purple_red','sort'=>20],
        ['num' => '1-7', 'sex' => 1, 'orientation' => '正南方', 'draw_key' => 'four_purple_red','sort'=>1],
        ['num' => '2-7', 'sex' => 1, 'orientation' => '正南方', 'draw_key' => 'four_purple_red','sort'=>1],
        ['num' => '12-7', 'sex' => 1, 'orientation' => '正南方', 'draw_key' => 'four_purple_red','sort'=>1],
        ['num' => '12-7', 'sex' => 1, 'orientation' => '西北偏北方', 'draw_key' => 'four_purple_blue','sort'=>20],
        ['num' => '6-10', 'sex' => 1, 'orientation' => '正西方', 'draw_key' => 'eight_yellow_black','sort'=>1],
        ['num' => '7-10', 'sex' => 1, 'orientation' => '正西方', 'draw_key' => 'eight_yellow_black','sort'=>1],
        ['num' => '6-11', 'sex' => 1, 'orientation' => '西北偏北方', 'draw_key' => 'eight_yellow_black','sort'=>20],
        ['num' => '7-11', 'sex' => 1, 'orientation' => '西北偏北方', 'draw_key' => 'eight_yellow_black','sort'=>20],
        ['num' => '7-11', 'sex' => 1, 'orientation' => '正南方', 'draw_key' => 'eight_yellow_red','sort'=>1],
        ['num' => '10-4', 'sex' => 1, 'orientation' => '正东方', 'draw_key' => 'two_blue_purple','sort'=>1],
        ['num' => '10-4', 'sex' => 1, 'orientation' => '正西方', 'draw_key' => 'twelve_brown_black','sort'=>1],
        ['num' => '11-4', 'sex' => 1, 'orientation' => '正东方', 'draw_key' => 'two_blue_purple','sort'=>1],
        ['num' => '10-5', 'sex' => 1, 'orientation' => '东南偏东方', 'draw_key' => 'two_blue_green','sort'=>20],
        ['num' => '11-5', 'sex' => 1, 'orientation' => '东南偏东方', 'draw_key' => 'two_blue_green','sort'=>20],
        ['num' => '4-3', 'sex' => 1, 'orientation' => '东北偏东方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-3', 'sex' => 1, 'orientation' => '东北偏东方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-3', 'sex' => 1, 'orientation' => '东南偏东方', 'draw_key' => 'seven_red_green','sort'=>20],
        ['num' => '4-8', 'sex' => 1, 'orientation' => '西南偏南方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-8', 'sex' => 1, 'orientation' => '西南偏南方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '4-9', 'sex' => 1, 'orientation' => '西南偏西方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-9', 'sex' => 1, 'orientation' => '西南偏西方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '3-1', 'sex' => 1, 'orientation' => '正北方', 'draw_key' => 'eleven_black_brown','sort'=>1],
        ['num' => '8-1', 'sex' => 1, 'orientation' => '正北方', 'draw_key' => 'eleven_black_brown','sort'=>1],
        ['num' => '8-1', 'sex' => 1, 'orientation' => '西南偏南方', 'draw_key' => 'eleven_black_yellow','sort'=>20],
        ['num' => '9-1', 'sex' => 1, 'orientation' => '正北方', 'draw_key' => 'eleven_black_brown','sort'=>1],
        ['num' => '9-1', 'sex' => 1, 'orientation' => '西南偏西方', 'draw_key' => 'ten_black_yellow','sort'=>20],
        ['num' => '3-2', 'sex' => 1, 'orientation' => '东北偏北方', 'draw_key' => 'eleven_black_blue','sort'=>20],
        ['num' => '8-2', 'sex' => 1, 'orientation' => '东北偏北方', 'draw_key' => 'eleven_black_blue','sort'=>20],
        ['num' => '9-2', 'sex' => 1, 'orientation' => '东北偏北方', 'draw_key' => 'eleven_black_blue','sort'=>20],
        ['num' => '3-12', 'sex' => 1, 'orientation' => '西北偏北方', 'draw_key' => 'eleven_black_brown','sort'=>20],
        ['num' => '8-12', 'sex' => 1, 'orientation' => '西北偏北方', 'draw_key' => 'eleven_black_brown','sort'=>20],
        ['num' => '9-12', 'sex' => 1, 'orientation' => '西北偏北方', 'draw_key' => 'eleven_black_brown','sort'=>20],
        ['num' => '1-6', 'sex' => 2, 'orientation' => '东南偏南方', 'draw_key' => 'four_purple_red','sort'=>20],
        ['num' => '2-6', 'sex' => 2, 'orientation' => '东南偏南方', 'draw_key' => 'four_purple_red','sort'=>20],
        ['num' => '2-6', 'sex' => 2, 'orientation' => '东北偏北方', 'draw_key' => 'five_green_blue','sort'=>20],
        ['num' => '12-6', 'sex' => 2, 'orientation' => '东南偏南方', 'draw_key' => 'four_purple_red','sort'=>20],
        ['num' => '1-7', 'sex' => 2, 'orientation' => '正南方', 'draw_key' => 'five_green_red','sort'=>1],
        ['num' => '2-7', 'sex' => 2, 'orientation' => '正南方', 'draw_key' => 'five_green_red','sort'=>1],
        ['num' => '12-7', 'sex' => 2, 'orientation' => '正南方', 'draw_key' => 'five_green_red','sort'=>1],
        ['num' => '12-7', 'sex' => 2, 'orientation' => '西北偏北方', 'draw_key' => 'five_green_blue','sort'=>20],
        ['num' => '6-10', 'sex' => 2, 'orientation' => '正西方', 'draw_key' => 'eight_yellow_black','sort'=>1],
        ['num' => '7-10', 'sex' => 2, 'orientation' => '正西方', 'draw_key' => 'eight_yellow_black','sort'=>1],
        ['num' => '6-11', 'sex' => 2, 'orientation' => '西北偏北方', 'draw_key' => 'eight_yellow_black','sort'=>20],
        ['num' => '7-11', 'sex' => 2, 'orientation' => '西北偏北方', 'draw_key' => 'eight_yellow_black','sort'=>20],
        ['num' => '7-11', 'sex' => 2, 'orientation' => '正南方', 'draw_key' => 'eight_yellow_red','sort'=>1],
        ['num' => '10-4', 'sex' => 2, 'orientation' => '正东方', 'draw_key' => 'two_blue_purple','sort'=>1],
        ['num' => '10-4', 'sex' => 2, 'orientation' => '正西方', 'draw_key' => 'twelve_brown_black','sort'=>1],
        ['num' => '11-4', 'sex' => 2, 'orientation' => '正东方', 'draw_key' => 'two_blue_purple','sort'=>1],
        ['num' => '10-5', 'sex' => 2, 'orientation' => '东南偏东方', 'draw_key' => 'two_blue_green','sort'=>20],
        ['num' => '11-5', 'sex' => 2, 'orientation' => '东南偏东方', 'draw_key' => 'two_blue_green','sort'=>20],
        ['num' => '4-3', 'sex' => 2, 'orientation' => '东北偏东方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-3', 'sex' => 2, 'orientation' => '东北偏东方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-3', 'sex' => 2, 'orientation' => '东南偏东方', 'draw_key' => 'seven_red_green','sort'=>20],
        ['num' => '4-8', 'sex' => 2, 'orientation' => '西南偏南方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-8', 'sex' => 2, 'orientation' => '西南偏南方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '4-9', 'sex' => 2, 'orientation' => '西南偏西方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '5-9', 'sex' => 2, 'orientation' => '西南偏西方', 'draw_key' => 'six_red_yellow','sort'=>20],
        ['num' => '3-1', 'sex' => 2, 'orientation' => '正北方', 'draw_key' => 'ten_black_brown','sort'=>1],
        ['num' => '8-1', 'sex' => 2, 'orientation' => '正北方', 'draw_key' => 'ten_black_brown','sort'=>1],
        ['num' => '8-1', 'sex' => 2, 'orientation' => '西南偏南方', 'draw_key' => 'ten_black_yellow','sort'=>20],
        ['num' => '9-1', 'sex' => 2, 'orientation' => '正北方', 'draw_key' => 'ten_black_brown','sort'=>1],
        ['num' => '9-1', 'sex' => 2, 'orientation' => '西南偏西方', 'draw_key' => 'ten_black_yellow','sort'=>20],
        ['num' => '3-2', 'sex' => 2, 'orientation' => '东北偏北方', 'draw_key' => 'ten_black_blue','sort'=>20],
        ['num' => '8-2', 'sex' => 2, 'orientation' => '东北偏北方', 'draw_key' => 'ten_black_blue','sort'=>20],
        ['num' => '9-2', 'sex' => 2, 'orientation' => '东北偏北方', 'draw_key' => 'ten_black_blue','sort'=>20],
        ['num' => '3-12', 'sex' => 2, 'orientation' => '西北偏北方', 'draw_key' => 'ten_black_brown','sort'=>20],
        ['num' => '8-12', 'sex' => 2, 'orientation' => '西北偏北方', 'draw_key' => 'ten_black_brown','sort'=>20],
        ['num' => '9-12', 'sex' => 2, 'orientation' => '西北偏北方', 'draw_key' => 'ten_black_brown','sort'=>20],
    ];

    /**
     * 摆放大成局
     * @param array $gram_nums 克关系数组
     * @param int $sex 性别 1男 2女
     */
    public function drawBigSuccess(array $gram_nums,$sex = 1)
    {
        $rows = collect($this->bigSuccessScenes)->where('sex',$sex)
            ->whereIn('num',$gram_nums)
            ->groupBy('draw')
            ->map(function($item,$key){
                $orientation = collect($item)->sortBy('sort')->pluck('orientation')->implode('、');
                $str = '摆放?颗?珠子，用?托盘装';
                $arr = $this->drawSuccess[$key];
                return $orientation.'：'.Str::replaceArray('?',$arr,$str);
            })->toArray();

        return $rows;
    }
}