<?php


namespace Maturest\Trigram\Traits;


trait VoltTrigramTrait
{
    protected $voltTrigramPositions = [
        '41' => ['x' => 333, 'y' => 185],
        '42' => ['x' => 333, 'y' => 310],
        '43' => ['x' => 333, 'y' => 436],
        '44' => ['x' => 333, 'y' => 554],
        '45' => ['x' => 333, 'y' => 675],
        '46' => ['x' => 333, 'y' => 797],
    ];

    protected $dzWx = [
        ['dz' => '子', 'wx' => '水'],
        ['dz' => '丑', 'wx' => '土'],
        ['dz' => '寅', 'wx' => '木'],
        ['dz' => '卯', 'wx' => '木'],
        ['dz' => '辰', 'wx' => '土'],
        ['dz' => '巳', 'wx' => '火'],
        ['dz' => '午', 'wx' => '火'],
        ['dz' => '未', 'wx' => '土'],
        ['dz' => '申', 'wx' => '金'],
        ['dz' => '酉', 'wx' => '金'],
        ['dz' => '戌', 'wx' => '土'],
        ['dz' => '亥', 'wx' => '水'],
    ];

    protected $wx = [
        '金', '木', '水', '火', '土',
    ];

    public function handleVoltTrigram()
    {
        //本卦中所有地支的五行
        $wxs = $this->getDiZhiWx();

        //如果五行缺失就启用标记伏爻
        if (count($wxs) < 5) {
            $this->voltTrigram($wxs);
        }

        return $this;
    }

    /**
     * 获取所有地支的五行
     * @return array
     */
    public function getDiZhiWx()
    {
        //取出所有地支
        $dzs = collect($this->getAllPosition())->pluck('dz')->unique()->toArray();
        //取出所有的地支五行
        $wxs = collect($this->dzWx)->whereIn('dz', $dzs)->pluck('wx')->unique()->toArray();

        return $wxs;
    }

    /**
     * 获取本卦中动爻，化爻，时令的位置
     * @return array
     */
    public function getAllPosition()
    {
        $ben = $this->getPositionsInlineBen();
        $trans = $this->getAllHuaPositions();
        $date = $this->getDatePositions();
        return array_merge($ben, $trans, $date);
    }

    public function getPositionsInlineBen()
    {
        $res = [];
        $arr = explode(',', $this->resultDiZhi['di_zhi']);
        foreach ($arr as $key => $value) {
            if ($value) {
                $res[] = [
                    'dz' => $value,
                    'column' => 4,
                    'row' => (6 - intval($key)),
                ];
            }
        }

        return $res;
    }

    /**
     * 获取日令与月令的位置
     * @return array[]
     */
    public function getDatePositions()
    {
        return [
            [
                'dz' => $this->diZhiDay,
                'column' => '6',
                'row' => '2',
            ],
            [
                'dz' => $this->diZhiMonth,
                'column' => '6',
                'row' => '1',
            ]
        ];
    }

    /**
     * 标记伏爻
     * @param $wxs
     */
    public function voltTrigram($wxs)
    {
        //缺失的五行
        $miss = array_diff($this->wx, $wxs);
        //找出缺失五行所对应的地支
        $dzs = collect($this->dzWx)->whereIn('wx', $miss)->pluck('dz')->toArray();
        //获取重装卦
        $gua = $this->getUpEqualDownGua();

        $res = [];
        foreach ($gua as $point) {
            if (in_array($point['dz'], $dzs)) {

                $dz_wx = collect($this->dzWx)->where('dz', $point['dz'])->first();

                $relation = collect($this->benGuaSixQin)->where('ben_gua', $this->resultDiZhi['ben_gua'])
                    ->where('wx', $dz_wx['wx'])->first();

                $res[] = [
                    'position' => $point['column'] . $point['row'],
                    'fu_yao' => '伏' . $relation['six_qin'] . $point['dz']
                ];
            }
        }

        $this->draw['fu_yao'] = $res;
    }

    /**
     * 获取本卦的重装挂
     * @return array
     */
    public function getUpEqualDownGua()
    {
        $gua = collect($this->totalGua)->where('ben_gua', $this->resultDiZhi['ben_gua'])
            ->filter(function ($item, $key) {
                return substr($key, 0, 3) == substr($key, 3, 3);
            })->first();

        $res = [];
        if ($gua) {
            $arr = explode(',', $gua['di_zhi']);
            foreach ($arr as $key => $value) {
                $row = 6 - $key;
                $res[] = ['dz' => $value, 'column' => '4', 'row' => $row];
            }
        }

        return $res;
    }
}
