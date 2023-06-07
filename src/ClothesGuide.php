<?php

namespace Maturest\Trigram;

use Maturest\Trigram\BaseService;

class ClothesGuide extends BaseService
{
    protected $wx = [
        ['wx' => '金', 'dz' => ['申', '酉'],],
        ['wx' => '木', 'dz' => ['寅', '卯'],],
        ['wx' => '水', 'dz' => ['子', '亥'],],
        ['wx' => '火', 'dz' => ['巳', '午'],],
        ['wx' => '土', 'dz' => ['丑', '辰', '未', '戌'],],
    ];

    protected $letters = [
        ['wx' => '金', 'proposal' => '建议您穿白色、银灰色为主，黑色、蓝色为辅的衣服', 'taboo' => '今日不宜穿绿色、紫色的衣服', 'diet' => '今日适宜吃白色、银灰色的食物，可增强体内的五行能量场'],
        ['wx' => '木', 'proposal' => '建议您穿绿色、紫色为主，红色为辅的衣服', 'taboo' => '今日不宜穿黄色的衣服', 'diet' => '今日适宜吃绿色、紫色的食物，可增强体内的五行能量场'],
        ['wx' => '水', 'proposal' => '建议您穿蓝色、黑色为主，绿色、紫色为辅的衣服', 'taboo' => '今日不宜穿红色的衣服', 'diet' => '今日适宜吃蓝色、黑色的食物，可增强体内的五行能量场'],
        ['wx' => '火', 'proposal' => '建议您穿红色为主，黄色为辅的衣服', 'taboo' => '今日不宜穿白色、银灰色的衣服', 'diet' => '今日适宜吃红色的食物，可增强体内的五行能量场'],
        ['wx' => '土', 'proposal' => '建议您穿黄色为主，白色、银灰色为辅的衣服', 'taboo' => '今日不宜穿黑色、蓝色的衣服', 'diet' => '今日适宜吃黄色的食物，可增强体内的五行能量场'],
    ];

    /**
     * This function retrieves a guide based on a given solar date.
     * 
     * @param date The input parameter "date" is a date string in the format of "YYYY-MM-DD"
     * representing the date for which the guide is to be retrieved.
     * 
     * @return a collection of letters that correspond to a specific guide based on a given solar date.
     */
    public function getGuideBySolar($date)
    {
        $this->solar($date);

        $dz = $this->dzYear($this->date_detail['ganzhi_day']);

        $row = collect($this->wx)->first(function ($item, $key) use ($dz) {
            return in_array($dz, $item['dz']);
        });

        return collect($this->letters)->where('wx', $row['wx'])->first();
    }
}
