<?php


namespace Maturest\Trigram\Traits\GodNums;


trait GodNums
{
    // 年先天数
    protected $yearFrontNums = [
        ['dz' => '子', 'front_num' => '1'],
        ['dz' => '丑', 'front_num' => '2'],
        ['dz' => '寅', 'front_num' => '3'],
        ['dz' => '卯', 'front_num' => '4'],
        ['dz' => '辰', 'front_num' => '5'],
        ['dz' => '巳', 'front_num' => '6'],
        ['dz' => '午', 'front_num' => '7'],
        ['dz' => '未', 'front_num' => '8'],
        ['dz' => '申', 'front_num' => '9'],
        ['dz' => '酉', 'front_num' => '10'],
        ['dz' => '戌', 'front_num' => '11'],
        ['dz' => '亥', 'front_num' => '12'],
    ];

    /**
     * 获取后天数
     * @param $frontNums
     * @return mixed
     */
    public function laterNums($frontNums)
    {
        $laterNums = collect($frontNums)->map(function ($item, $key) {
            return $item <= 6 ? ($item + 6) : ($item - 6);
        })->toArray();

        return $laterNums;
    }

    /**
     * 获取先天数
     * @param $calendar
     * @param $date
     * @return array
     */
    protected function frontNums($date)
    {
        $year_num = $this->frontYearNum($this->date_detail['ganzhi_year']);
        $month_num = $this->frontMonthNum($this->date_detail['lunar_month']);
        $day_num = $this->frontDayNum($this->date_detail['lunar_day']);
        $hour_num = $this->frontHourNum($date);
        return array_merge($year_num, $month_num, $day_num, $hour_num);
    }

    /**
     * 年先天数
     * @param $gz_year
     * @return int[]
     */
    protected function frontYearNum($gz_year)
    {
        $row = collect($this->yearFrontNums)->where('dz', $this->dzYear($gz_year))->first();
        return [$row['front_num'] ?? 0];
    }

    /**
     * 月先天数
     * @param $month
     * @return int[]
     */
    protected function frontMonthNum($month)
    {
        return [intval($month) ?: 0];
    }

    /**
     * 日先天数
     * @param $day
     * @return array
     */
    protected function frontDayNum($day)
    {
        $day = intval($day);
        if ($day <= 12) {
            return [$day];
        } else {
            $quotient = intval(floor($day / 10));
            $remainder = $day % 10;
            if ($remainder == 0)
                return [$quotient, 10];
            return [$quotient, 10, $remainder];
        }
    }

    /**
     * 时先天数
     * @param $date
     * @return array|int[]
     */
    protected function frontHourNum($date)
    {
        // 24小时制的时间格式 比如23:02 就写2302
        $hour = intval(date('Gi', strtotime($date)));
        // 十二时辰
        $hours = [
            ['hours' => [100, 300], 'front_num' => 2],
            ['hours' => [300, 500], 'front_num' => 3],
            ['hours' => [500, 700], 'front_num' => 4],
            ['hours' => [700, 900], 'front_num' => 5],
            ['hours' => [900, 1100], 'front_num' => 6],
            ['hours' => [1100, 1300], 'front_num' => 7],
            ['hours' => [1300, 1500], 'front_num' => 8],
            ['hours' => [1500, 1700], 'front_num' => 9],
            ['hours' => [1700, 1900], 'front_num' => 10],
            ['hours' => [1900, 2100], 'front_num' => 11],
            ['hours' => [2100, 2300], 'front_num' => 12],
        ];

        $row = collect($hours)->first(function ($item, $key) use ($hour) {
            [$floor, $ceil] = $item['hours'];
            return $floor <= $hour && $hour < $ceil;
        });

        if (is_null($row))
            return [1];

        return [$row['front_num']];
    }

    /**
     * 创建新的数组
     * @param $nums
     * @return array
     */
    protected function createNewArr($nums)
    {
        $arr = [];
        //头部
        $arr[] = '';
        foreach ($nums as $key => $num) {
            $arr[] = $num;
            $arr[] = '';
        }

        return $arr;
    }
}