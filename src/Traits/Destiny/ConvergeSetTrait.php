<?php


namespace Maturest\Trigram\Traits\Destiny;


use Illuminate\Support\Str;

trait ConvergeSetTrait
{

    protected $joinImages = [
        ['hui_ju' => '汇子局', 'torn' => false, 'img' => 'hui_ju/hz.png'],
        ['hui_ju' => '汇兄局', 'torn' => false, 'img' => 'hui_ju/hx.png'],
        ['hui_ju' => '汇父局', 'torn' => false, 'img' => 'hui_ju/hf.png'],
        ['hui_ju' => '汇官局', 'torn' => false, 'img' => 'hui_ju/hg.png'],
        ['hui_ju' => '汇财局', 'torn' => false, 'img' => 'hui_ju/hc.png'],
        ['hui_ju' => '汇子局', 'torn' => true, 'img' => 'hui_ju/hzp.png'],
        ['hui_ju' => '汇兄局', 'torn' => true, 'img' => 'hui_ju/hxp.png'],
        ['hui_ju' => '汇父局', 'torn' => true, 'img' => 'hui_ju/hfp.png'],
        ['hui_ju' => '汇官局', 'torn' => true, 'img' => 'hui_ju/hgp.png'],
        ['hui_ju' => '汇财局', 'torn' => true, 'img' => 'hui_ju/hcp.png'],
    ];


    protected $dangerous = [
        '木变金：朝北拜玄天上帝，化解本卦的金煞',
        '火变水：朝东拜神农大帝，化解本卦的水煞',
        '土变木：朝南拜关圣帝君，化解本卦的木煞',
        '金变火：朝西拜地藏王菩萨，化解本卦的火煞',
        '水变土：朝西拜观世音菩萨，化解本卦的土煞',
    ];


    protected $huiJu = [
        ['hui_ju' => ['寅', '午', '戌'], 'hui' => '火', 'jx' => '午'],
        ['hui_ju' => ['亥', '卯', '未'], 'hui' => '木', 'jx' => '卯'],
        ['hui_ju' => ['申', '子', '辰'], 'hui' => '水', 'jx' => '子'],
        ['hui_ju' => ['巳', '酉', '丑'], 'hui' => '金', 'jx' => '酉'],
    ];


    protected $benGuaSixQin = [
        ['ben_gua' => '乾金', 'sheng_ke' => '同我', 'wx' => '金', 'six_qin' => '兄'],
        ['ben_gua' => '乾金', 'sheng_ke' => '我生', 'wx' => '水', 'six_qin' => '子'],
        ['ben_gua' => '乾金', 'sheng_ke' => '生我', 'wx' => '土', 'six_qin' => '父'],
        ['ben_gua' => '乾金', 'sheng_ke' => '我克', 'wx' => '木', 'six_qin' => '财'],
        ['ben_gua' => '乾金', 'sheng_ke' => '克我', 'wx' => '火', 'six_qin' => '官'],
        ['ben_gua' => '坎水', 'sheng_ke' => '同我', 'wx' => '水', 'six_qin' => '兄'],
        ['ben_gua' => '坎水', 'sheng_ke' => '我生', 'wx' => '木', 'six_qin' => '子'],
        ['ben_gua' => '坎水', 'sheng_ke' => '生我', 'wx' => '金', 'six_qin' => '父'],
        ['ben_gua' => '坎水', 'sheng_ke' => '我克', 'wx' => '火', 'six_qin' => '财'],
        ['ben_gua' => '坎水', 'sheng_ke' => '克我', 'wx' => '土', 'six_qin' => '官'],
        ['ben_gua' => '艮土', 'sheng_ke' => '同我', 'wx' => '土', 'six_qin' => '兄'],
        ['ben_gua' => '艮土', 'sheng_ke' => '我生', 'wx' => '金', 'six_qin' => '子'],
        ['ben_gua' => '艮土', 'sheng_ke' => '生我', 'wx' => '火', 'six_qin' => '父'],
        ['ben_gua' => '艮土', 'sheng_ke' => '我克', 'wx' => '水', 'six_qin' => '财'],
        ['ben_gua' => '艮土', 'sheng_ke' => '克我', 'wx' => '木', 'six_qin' => '官'],
        ['ben_gua' => '震木', 'sheng_ke' => '同我', 'wx' => '木', 'six_qin' => '兄'],
        ['ben_gua' => '震木', 'sheng_ke' => '我生', 'wx' => '火', 'six_qin' => '子'],
        ['ben_gua' => '震木', 'sheng_ke' => '生我', 'wx' => '水', 'six_qin' => '父'],
        ['ben_gua' => '震木', 'sheng_ke' => '我克', 'wx' => '土', 'six_qin' => '财'],
        ['ben_gua' => '震木', 'sheng_ke' => '克我', 'wx' => '金', 'six_qin' => '官'],
        ['ben_gua' => '巽木', 'sheng_ke' => '同我', 'wx' => '木', 'six_qin' => '兄'],
        ['ben_gua' => '巽木', 'sheng_ke' => '我生', 'wx' => '火', 'six_qin' => '子'],
        ['ben_gua' => '巽木', 'sheng_ke' => '生我', 'wx' => '水', 'six_qin' => '父'],
        ['ben_gua' => '巽木', 'sheng_ke' => '我克', 'wx' => '土', 'six_qin' => '财'],
        ['ben_gua' => '巽木', 'sheng_ke' => '克我', 'wx' => '金', 'six_qin' => '官'],
        ['ben_gua' => '离火', 'sheng_ke' => '同我', 'wx' => '火', 'six_qin' => '兄'],
        ['ben_gua' => '离火', 'sheng_ke' => '我生', 'wx' => '土', 'six_qin' => '子'],
        ['ben_gua' => '离火', 'sheng_ke' => '生我', 'wx' => '木', 'six_qin' => '父'],
        ['ben_gua' => '离火', 'sheng_ke' => '我克', 'wx' => '金', 'six_qin' => '财'],
        ['ben_gua' => '离火', 'sheng_ke' => '克我', 'wx' => '水', 'six_qin' => '官'],
        ['ben_gua' => '兑金', 'sheng_ke' => '同我', 'wx' => '金', 'six_qin' => '兄'],
        ['ben_gua' => '兑金', 'sheng_ke' => '我生', 'wx' => '水', 'six_qin' => '子'],
        ['ben_gua' => '兑金', 'sheng_ke' => '生我', 'wx' => '土', 'six_qin' => '父'],
        ['ben_gua' => '兑金', 'sheng_ke' => '我克', 'wx' => '木', 'six_qin' => '财'],
        ['ben_gua' => '兑金', 'sheng_ke' => '克我', 'wx' => '火', 'six_qin' => '官'],
        ['ben_gua' => '坤土', 'sheng_ke' => '同我', 'wx' => '土', 'six_qin' => '兄'],
        ['ben_gua' => '坤土', 'sheng_ke' => '我生', 'wx' => '金', 'six_qin' => '子'],
        ['ben_gua' => '坤土', 'sheng_ke' => '生我', 'wx' => '火', 'six_qin' => '父'],
        ['ben_gua' => '坤土', 'sheng_ke' => '我克', 'wx' => '水', 'six_qin' => '财'],
        ['ben_gua' => '坤土', 'sheng_ke' => '克我', 'wx' => '木', 'six_qin' => '官'],
    ];


    /**
     * A function that is used to calculate the relationship between the two people.
     */
    public function handleRelationConvergeSet()
    {
        $up = [];
        $down = [];
        $join_up = $this->joinDiZhi(-3);

        if (count($join_up) >= 3) {
            $up = $this->getHuiJu($join_up, 'up');
        }

        $join_down = $this->joinDiZhi(3);

        if (count($join_down) >= 3) {
            $down = $this->getHuiJu($join_down, 'down');
        }
        $hui_ju = array_merge($up, $down);

        $this->draw['hui_ju'] = $hui_ju;

        return $this;
    }


    /**
     * It takes the first 6 positions of the gua and the first 6 positions of the trans gua, and the
     * day and month positions of the date, and returns an array of the positions of the di zhi in the
     * gua
     *
     * @param limit the number of positions to be returned
     */
    public function joinDiZhi($limit)
    {
        $ben_gua_di_zhi = collect($this->benGuaDetail)->take($limit)->filter(function ($item, $key) {
            return $item['is_dong'] || $item['is_an_dong'];
        })->toArray();

        $ben_gua_dz_positions = [];
        if ($ben_gua_di_zhi) {
            foreach ($ben_gua_di_zhi as $gua_dz) {
                $ben_gua_dz_positions[] = [
                    'dz' => $gua_dz['dz'],
                    'column' => $gua_dz['column'],
                    'row' => $gua_dz['row'],
                ];
            }
        }

        $trans_dz_positions = [];
        if ($this->transGuaExists()) {
            $trans_di_zhi = collect(explode(',', $this->resultDiZhi['trans_di_zhi']))
                ->take($limit)->filter()->toArray();

            foreach ($trans_di_zhi as $key => $trans_dz) {
                $trans_dz_positions[] = [
                    'dz' => $trans_dz,
                    'column' => 5,
                    'row' => 6 - intval($key),
                ];
            }
        }

        $date_dz_positions = [
            [
                'dz' => $this->diZhiDay,
                'column' => 6,
                'row' => 2,
            ],
            [
                'dz' => $this->diZhiMonth,
                'column' => 6,
                'row' => 1,
            ],
        ];

        $res = array_merge($ben_gua_dz_positions, $trans_dz_positions, $date_dz_positions);

        return $res;
    }


    /**
     * A function to get the hui ju.
     *
     * @param dz_arr the array of the six points of the hexagram
     * @param type up or down, up is the upper trigram, down is the lower trigram
     */
    public function getHuiJu($dz_arr, $type = 'up')
    {
        $res = [];
        $res[$type] = [];

        $dz = collect($dz_arr)->pluck('dz')->unique();

        if ($dz->count() >= 3) {
            $str = $dz->implode(',');
            foreach ($this->huiJu as $hui_ju) {
                if (Str::containsAll($str, $hui_ju['hui_ju'])) {
                    $hui = $hui_ju['hui'];
                    $row = collect($this->benGuaSixQin)->where('ben_gua', $this->resultDiZhi['ben_gua'])
                        ->where('wx', $hui)
                        ->first();

                    $torn = $this->markIsTorn($hui_ju['jx'], $dz_arr);

                    $jx_point = collect($dz_arr)->where('dz', $hui_ju['jx'])->first();

                    $hg = [
                        'hui_ju' => '汇' . $row['six_qin'] . '局',
                        'hui_wx' => $hui_ju['hui'] ?? '',
                        'torn' => $torn,
                        'jx' => $hui_ju['jx'],
                        'dzs' => $hui_ju['hui_ju'],
                        'jx_position' => $jx_point['column'] . $jx_point['row'],
                    ];

                    $res[$type][] = $hg;
                }
            }
        }

        return $res;
    }


    /**
     * It checks if a given dz is torn
     *
     * @param dz the current dz
     * @param dz_arr the array of all the data in the table
     */
    public function markIsTorn($dz, $dz_arr)
    {
        $res = false;

        $jxs = collect($dz_arr)->where('dz', $dz);
        if ($jxs->count()) {
            $jxs = $jxs->toArray();

            foreach ($jxs as $jx) {

                if ($jx['column'] == 4) {
                    $res = $this->isTornBen($dz, $dz_arr, $jx);
                    if ($res) {
                        return $res;
                    }
                }

                if ($jx['column'] == 5) {
                    $res = $this->isTornHua($dz, $dz_arr, $jx);
                    if ($res) {
                        return $res;
                    }
                }

                if ($jx['column'] == 6) {
                    $res = $this->isTornLing($dz, $dz_arr);
                    if ($res) {
                        return $res;
                    }
                }
            }
        }

        return $res;
    }


    /**
     * > It checks if a given gua is a ben gua
     *
     * @param dz the current dizhi
     * @param dz_arr the array of the current hexagram
     * @param jx the current hexagram
     */
    public function isTornBen($dz, $dz_arr, $jx)
    {
        $ben = collect($this->benGuaDetail)->filter(function ($item, $key) {
            return $item['is_dong'] || $item['is_an_dong'];
        })->toArray();

        $ben = collect($ben)->where('column', $jx['column'])->toArray();
        foreach ($ben as $value) {
            if ($this->isCongRelation($dz, $value['dz'])) {
                return true;
            }
        }

        $hua = collect($dz_arr)->where('column', 5)
            ->where('row', $jx['row'])->first();

        if ($hua) {
            if ($this->isCongRelation($dz, $hua['dz'])) {
                return true;
            }
        }

        $lings = collect($dz_arr)->where('column', 6)->toArray();
        foreach ($lings as $val) {
            if ($this->isCongRelation($dz, $val['dz'])) {
                return true;
            }
        }

        return false;
    }


    /**
     * > If the current dizhi is in the same column as the ben dizhi, or in the same column as any of
     * the lings dizhi, then return true
     *
     * @param dz the current position
     * @param dz_arr the array of all the dzs in the current jx
     * @param jx the current card
     */
    public function isTornHua($dz, $dz_arr, $jx)
    {
        $ben = collect($dz_arr)->where('column', 4)
            ->where('row', $jx['row'])->first();
        if ($this->isCongRelation($dz, $ben['dz'])) {
            return true;
        }

        $lings = collect($dz_arr)->where('column', 6)->toArray();
        foreach ($lings as $val) {
            if ($this->isCongRelation($dz, $val['dz'])) {
                return true;
            }
        }

        return false;
    }


    /**
     * > If the current dz is a cong relation with any of the dzs in the array, return true
     *
     * @param dz the current dz
     * @param dz_arr an array of dz's that are already in the sentence.
     */
    public function isTornLing($dz, $dz_arr)
    {
        foreach ($dz_arr as $dz_arr_val) {
            if ($this->isCongRelation($dz, $dz_arr_val['dz'])) {
                return true;
            }
        }
        return false;
    }
}
