<?php


namespace Maturest\Trigram\Traits\Destiny;


use Illuminate\Support\Str;

trait ConvergeSetTrait
{
    // 汇局的图片
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

    // 凶卦提示语
    protected $dangerous = [
        '木变金：朝北拜玄天上帝，化解本卦的金煞',
        '火变水：朝东拜神农大帝，化解本卦的水煞',
        '土变木：朝南拜关圣帝君，化解本卦的木煞',
        '金变火：朝西拜地藏王菩萨，化解本卦的火煞',
        '水变土：朝西拜观世音菩萨，化解本卦的土煞',
    ];


    // 汇局
    protected $huiJu = [
        ['hui_ju' => ['寅', '午', '戌'], 'hui' => '火', 'jx' => '午'],
        ['hui_ju' => ['亥', '卯', '未'], 'hui' => '木', 'jx' => '卯'],
        ['hui_ju' => ['申', '子', '辰'], 'hui' => '水', 'jx' => '子'],
        ['hui_ju' => ['巳', '酉', '丑'], 'hui' => '金', 'jx' => '酉'],
    ];


    // 本卦六亲
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
     * 处理汇局
     * 要求：
     * 1、上卦归上卦，下卦归下卦，单独汇局
     * 2、上卦动爻、暗动、天时（月令、日令中的地支）共同参与汇局
     * 3、下卦动爻、暗动、天时（月令、日令中的地支）共同参与汇局
     *
     */
    public function handleRelationConvergeSet()
    {
        $up = [];
        $down = [];
        $join_up = $this->joinDiZhi(-3);
        // 上下卦的地支数量至少3个才论汇局
        if (count($join_up) >= 3) {
            // 判断上卦的汇局情况
            $up = $this->getHuiJu($join_up, 'up');
        }

        $join_down = $this->joinDiZhi(3);

        if (count($join_down) >= 3) {
            // 判断下卦的汇局情况
            $down = $this->getHuiJu($join_down, 'down');
        }
        $hui_ju = array_merge($up, $down);

        $this->draw['hui_ju'] = $hui_ju;

        return $this;
    }

    /**
     * 取出论汇局中的上下卦的所有地支
     * @param $limit
     * @return array
     */
    public function joinDiZhi($limit)
    {
        // 本卦动爻的地支
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

        // 取出 上卦中的 化爻
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

        // 取出日令,月令
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
     * 获取上下卦的汇局
     * @param $dz_arr
     * @param string $type
     */
    public function getHuiJu($dz_arr, $type = 'up')
    {
        //初始化
        $res = [];
        $res[$type] = [];

        // 汇局至少要有三个，并且不一样的
        $dz = collect($dz_arr)->pluck('dz')->unique();

        if ($dz->count() >= 3) {
            $str = $dz->implode(',');
            foreach ($this->huiJu as $hui_ju) {
                if (Str::containsAll($str, $hui_ju['hui_ju'])) {
                    $hui = $hui_ju['hui'];
                    $row = collect($this->benGuaSixQin)->where('ben_gua', $this->resultDiZhi['ben_gua'])
                        ->where('wx', $hui)
                        ->first();

                    //标记是否为破
                    $torn = $this->markIsTorn($hui_ju['jx'], $dz_arr);

                    $hg = [
                        'hui_ju' => '汇' . $row['six_qin'] . '局',
                        'torn' => $torn,
                        'jx' => $hui_ju['jx'],
                    ];

                    $res[$type][] = $hg;
                }
            }
        }

        return $res;
    }

    /**
     * 判断一个地支与地支数组中的任意一个是否存在六冲关系
     * @param $dz
     * @param $dz_arr
     * @return bool
     */
    public function markIsTorn($dz, $dz_arr)
    {
        $res = false;
        //1、先看将星的位置
        $jxs = collect($dz_arr)->where('dz', $dz);
        if ($jxs->count()) {
            $jxs = $jxs->toArray();
            //已将星为中心，去找自己的六冲
            foreach ($jxs as $jx) {
                //如果是本爻，本爻与本爻，本爻与自己的化爻，本爻与日令，月令相比较
                if ($jx['column'] == 4) {
                    $res = $this->isTornBen($dz, $dz_arr, $jx);
                }

                // 如果将星位置在化爻
                if ($jx['column'] == 5) {
                    $res = $this->isTornHua($dz, $dz_arr, $jx);
                }

                //如果将星在日令 月令位置
                if ($jx['column'] == 6) {
                    $res = $this->isTornLing($dz, $dz_arr);
                }
            }
        }

        return $res;
    }

    /**
     * 将星在本卦列
     * @param $dz
     * @param $dz_arr
     * @param $jx
     * @return bool
     */
    public function isTornBen($dz, $dz_arr, $jx)
    {
        //取出本爻
        $ben = collect($dz_arr)->where('column', $jx['column'])->toArray();
        foreach ($ben as $value) {
            if ($this->isCongRelation($dz, $value['dz'])) {
                return true;
            }
        }

        // 本爻只能与自己的化爻
        $hua = collect($dz_arr)->where('column', 5)
            ->where('row', $jx['row'])->first();

        // 如果是暗动的话，是没有化爻的
        if ($hua) {
            if ($this->isCongRelation($dz, $hua['dz'])) {
                return true;
            }
        }

        // 与月令 日令相比
        $lings = collect($dz_arr)->where('column', 6)->toArray();
        foreach ($lings as $val) {
            if ($this->isCongRelation($dz, $val['dz'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * 将星在化爻列
     * @param $dz
     * @param $dz_arr
     * @param $jx
     * @return bool
     */
    public function isTornHua($dz, $dz_arr, $jx)
    {
        //化爻只能与自己的本爻比较
        $ben = collect($dz_arr)->where('column', 4)
            ->where('row', $jx['row'])->first();
        if ($this->isCongRelation($dz, $ben['dz'])) {
            return true;
        }

        //化爻与日令 月令相比
        $lings = collect($dz_arr)->where('column', 6)->toArray();
        foreach ($lings as $val) {
            if ($this->isCongRelation($dz, $val['dz'])) {
                return true;
            }
        }

        // 化爻与化爻之间是不能比较的
        return false;
    }

    /**
     * 将星在日令 月令列
     * @param $dz
     * @param $dz_arr
     * @return bool
     */
    public function isTornLing($dz, $dz_arr)
    {
        //简化一下，直接与所有的比较
        foreach ($dz_arr as $dz_arr_val) {
            if ($this->isCongRelation($dz, $dz_arr_val['dz'])) {
                return true;
            }
        }
        return false;
    }

}
