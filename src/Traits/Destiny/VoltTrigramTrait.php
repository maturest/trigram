<?php


namespace Maturest\Trigram\Traits\Destiny;


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

    /**
     * It checks if the trigram is a volt trigram.
     *
     * @return The object itself.
     */
    public function handleVoltTrigram()
    {
        $wxs = $this->getDiZhiWx();

        if (count($wxs) < 5) {
            $this->voltTrigram($wxs);
        }

        return $this;
    }


    /**
     * It returns an array of unique weather stations for a given set of unique locations.
     */
    public function getDiZhiWx()
    {
        $dzs = collect($this->getAllPosition())->pluck('dz')->unique()->toArray();

        $wxs = collect($this->dzWx)->whereIn('dz', $dzs)->pluck('wx')->unique()->toArray();

        return $wxs;
    }


    /**
     * It gets all the positions from the database and returns them as an array
     *
     * @return An array of all the positions in the inline ben, all the positions in the hua, and all
     * the positions in the date.
     */
    public function getAllPosition()
    {
        $ben = $this->getPositionsInlineBen();
        $trans = $this->getAllHuaPositions();
        $date = $this->getDatePositions();
        return array_merge($ben, $trans, $date);
    }

    /**
     * It takes a string of numbers, and returns an array of arrays
     */
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
     * > It returns an array of arrays, each of which contains the day and month branch of the date,
     * the column and row of the cell in the table where the branch should be placed, and the branch's
     * position in the table
     *
     * @return An array of arrays.
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
     * A function to calculate the trigrams that are hidden in the hexagram.
     *
     * @param wxs the trigrams of the six positions of the hexagram
     */
    public function voltTrigram($wxs)
    {
        $miss = array_diff($this->wx, $wxs);

        $dzs = collect($this->dzWx)->whereIn('wx', $miss)->pluck('dz')->toArray();

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
     * > Get the gua that has the same up and down trigrams
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
