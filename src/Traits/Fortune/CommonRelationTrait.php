<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

/**
 * 公共关系
 * Trait CommonRelationTrait
 * @package Maturest\Trigram\Traits\Fortune
 */
trait CommonRelationTrait
{

    /**
     * 全局动态设置用神的位置
     * @param $position
     */
    public function setGodPositions($positions)
    {
        $this->god_positions = $positions;
    }

    /**
     * 获取用神的五行
     * @return mixed|null
     */
    public function getGodWx()
    {
        $position = $this->god_positions[0];
        return $position['wx'] ?? null;
    }

    /**
     * 某一位置的五行是不是被日令月令克
     * @param $wx
     * @return bool
     */
    public function isWithDateKe($wx)
    {
        //日令月令的五行
        $wxs = $this->getDateWx();

        $wx_ke_me = $this->getWhoKeMe($wx);

        return in_array($wx_ke_me, $wxs);
    }

    /**
     * 获取日令月令的五行
     * @return array
     */
    public function getDateWx()
    {
        return [
            $this->getDayWx(),
            $this->getMonthWx(),
        ];
    }

    /**
     * 获取日令的五行
     * @return mixed
     */
    public function getDayWx()
    {
        return $this->getWxByDz($this->getDayDz());
    }

    /**
     * 通过十二地支获取五行
     * @param $dz
     * @return mixed
     */
    public function getWxByDz($dz)
    {
        $dz_wx = collect($this->dzWx)->where('dz', $dz)->first();
        return $dz_wx['wx'];
    }

    /**
     * 获取日令的地支
     * @return mixed
     */
    public function getDayDz()
    {
        return $this->diZhiDay;
    }

    /**
     * 获取月令的五行
     * @return mixed
     */
    public function getMonthWx()
    {
        return $this->getWxByDz($this->getMonthDz());
    }

    /**
     * 获取月令的地支
     * @return mixed
     */
    public function getMonthDz()
    {
        return $this->diZhiMonth;
    }

    /**
     * 获取日令月令的地支
     * @return array
     */
    public function getDateDz()
    {
        return [
            $this->getDayDz(),
            $this->getMonthDz(),
        ];
    }

    /**
     * 获取某一爻的五行是否被动爻生
     * @param $wx
     * @return bool
     */
    public function getIsDongYaoGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        return in_array($grow_me_wx, $this->getDongYaoWx());
    }

    /**
     * 获取动爻的五行
     * @return array
     */
    public function getDongYaoWx()
    {
        $dong_dzs = $this->getDongYaoDz();
        $dong_wxs = [];
        foreach ($dong_dzs as $dong_dz) {
            $dong_wxs[] = $this->getWxByDz($dong_dz);
        }
        return $dong_wxs;
    }

    /**
     * 获取静爻的五行
     *
     * @return array
     */
    public function getStaticYaoWx()
    {
        $static_dzs = $this->getStaticYaoDz();
        $static_wxs = [];
        foreach ($static_dzs as $static_dz) {
            $static_wxs[] = $this->getWxByDz($static_dz);
        }
        return $static_wxs;
    }

    /**
     * 获取动爻的地支
     * @return mixed
     */
    public function getDongYaoDz()
    {
        $dong_yao = $this->getDongYao();
        return $dong_yao->pluck('dz')->toArray();
    }

    /**
     * 获取动爻的位置
     * @return mixed
     */
    public function getDongYao()
    {
        return collect($this->benGuaDetail)->filter(function ($item, $key) {
            return $item['is_dong'] || $item['is_an_dong'];
        });
    }

    /**
     * 获取静爻的位置
     *
     * @return mixed
     */
    public function getStaticYao()
    {
        return collect($this->benGuaDetail)->filter(function ($item, $key) {
            return $item['is_dong'] == false && $item['is_an_dong'] == false;
        });
    }

    /**
     * 获取静爻的地支
     *
     * @return mixed
     */
    public function getStaticYaoDz()
    {
        $static_yao = $this->getStaticYao();
        return $static_yao->pluck('dz')->toArray();
    }

    /**
     * 静爻是否来生
     *
     * @param string 五行
     * @return void
     */
    public function getIsStaticYaoGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        return in_array($grow_me_wx, $this->getStaticYaoWx());
    }

    /**
     * 是否动爻和化爻来生
     * @return bool
     */
    public function getIsDongAndTransYaoGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        $wxs = array_merge($this->getDongYaoWx(), $this->getTransYaoWx());
        return in_array($grow_me_wx, $wxs);
    }

    /**
     * 获取化爻的五行
     * @return array
     */
    public function getTransYaoWx()
    {
        $trans_dzs = $this->getTransYaoDz();
        $trans_wxs = [];
        foreach ($trans_dzs as $trans_dz) {
            $trans_wxs[] = $this->getWxByDz($trans_dz);
        }
        return $trans_wxs;
    }

    /**
     * 获取化爻的地支
     * @return mixed
     */
    public function getTransYaoDz()
    {
        return collect($this->getTransDetail())->pluck('dz')->toArray();
    }

    /**
     * 获取化爻的详情
     * @return array
     */
    public function getTransDetail()
    {
        $trans = [];
        $arr = $this->getTransArr();
        foreach ($arr as $key => $dz) {
            $trans[] = [
                'column' => "5",
                'row' => $key + 1,
                'is_dong' => false,
                'is_an_dong' => false,
                'dz' => $dz,
            ];
        }
        return $trans;
    }

    /**
     * 获取化爻的数组
     * @return array|false|string[]
     */
    public function getTransArr()
    {
        return array_reverse(explode(',', $this->resultDiZhi['trans_di_zhi']));
    }

    /**
     * 判断某一爻的五行是否被日令月令生
     * @param $wx
     * @return bool
     */
    public function getIsDateGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        return in_array($grow_me_wx, $this->getDateWx());
    }

    /**
     * 获取生某一爻的爻不带合或入
     * @param string $wx 某一爻的五行
     * @return bool
     */
    public function withoutHeOrRuByGrowMe($wx)
    {
        $result = false;
        $grow_me_wx = $this->getWhoGrowMe($wx);

        foreach ($this->getDongYao() as $yao) {
            if ($grow_me_wx == $this->getWxByDz($yao['dz'])) {
                $position = $yao['column'] . $yao['row'];
                //带不带合
                if ($this->isWithHe($position)) {
                    $result = true;
                    break;
                }
                //带不带入
                if ($this->isWithRu($position)) {
                    $result = true;
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * 判断某一位置是否携带合
     * @param $position
     * @return bool
     */
    public function isWithHe($position)
    {
        $with_he = false;
        foreach ($this->draw['six_he'] as $six_he) {
            if (Str::contains($six_he, $position)) {
                $with_he = true;
                break;
            }
        }
        return $with_he;
    }

    /**
     * 判断某一位置是否携带入
     * @param $position
     * @return bool
     */
    public function isWithRu($position)
    {
        $with_ru = false;
        foreach ($this->draw['ru_mu'] as $ru_mu) {
            if (Str::contains($ru_mu, $position)) {
                $with_ru = true;
                break;
            }
        }
        return $with_ru;
    }

    /**
     * 判断某个位置是否空亡
     * @param $position
     * @return bool
     */
    public function getIsKongWangByPosition($position)
    {
        $coords = $this->draw['kong_wang']['coords'];

        foreach ($coords as $coord) {
            return $coord['position'] == $position['position'];
        }

        return false;
    }

    /**
     * 获取生我的五行位置
     * @param $wx
     * @return array
     */
    public function getPositionsWhoGrowMe($wx)
    {
        $wx_grow_me = $this->getWhoGrowMe($wx);
        $positions = [];
        foreach ($this->getDongYao() as $yao) {
            if ($wx_grow_me == $this->getWxByDz($yao['dz'])) {
                $positions[] = ['position' => $yao['column'] . $yao['row']];
            }
        }

        return $positions;
    }

    /**
     * 通过六亲找到对应的位置
     * @param $six_qin
     * @return array
     */
    public function getPositionsWithSixQin($six_qin, $contain_date = false)
    {
        $positions = [];

        //本卦中的六亲
        $tmp_arr = explode(',', $this->resultDiZhi['liu_qin']);
        foreach ($tmp_arr as $key => $value) {
            if ($value == $six_qin) {
                $positions[] = [
                    'position' => $this->benGuaDetail[$key]['column'] . $this->benGuaDetail[$key]['row'],
                    'is_dong' => $this->benGuaDetail[$key]['is_dong'],
                    'is_an_dong' => $this->benGuaDetail[$key]['is_an_dong'],
                    'trans' => false,
                    'fu' => false,
                    'dz' => $this->benGuaDetail[$key]['dz'],
                    'wx' => $this->getWxByDz($this->benGuaDetail[$key]['dz']),
                ];
            }
        }

        // 化爻中的六亲
        $arr = $this->getTransArr();
        foreach ($arr as $key => $dz) {
            if ($six_qin == $this->getSixQinByDz($dz)) {
                $positions[] = [
                    'position' => '5' . ($key + 1),
                    'is_dong' => false,
                    'is_an_dong' => false,
                    'trans' => true,
                    'fu' => false,
                    'dz' => $dz,
                    'wx' => $this->getWxByDz($dz),
                ];
            }
        }


        //如果是伏爻
        foreach ($this->draw['fu_yao'] as $fu_yao) {
            if (Str::startsWith($fu_yao['fu_yao'], '伏' . $six_qin)) {

                $dz = mb_substr($fu_yao['fu_yao'], -1);

                $ben_yao = collect($this->benGuaDetail)
                    ->where('column', $fu_yao['position'][0])
                    ->where('row', $fu_yao['position'][1])
                    ->first();

                $positions[] = [
                    'position' => $fu_yao['position'],
                    'is_dong' => $ben_yao['is_dong'],
                    'is_an_dong' => $ben_yao['is_an_dong'],
                    'trans' => false,
                    'fu' => true,
                    'dz' => $dz,
                    'wx' => $this->getWxByDz($dz),
                ];
            }
        }

        if ($contain_date) {
            //日令
            if ($six_qin == $this->getSixQinByDz($this->getDayDz())) {
                $positions[] = [
                    'position' => '62',
                    'is_dong' => false,
                    'is_an_dong' => false,
                    'trans' => false,
                    'fu' => false,
                    'dz' => $this->getDayDz(),
                    'wx' => $this->getDayWx(),
                ];
            }

            //月令
            if ($six_qin == $this->getSixQinByDz($this->getMonthDz())) {
                $positions[] = [
                    'position' => '61',
                    'is_dong' => false,
                    'is_an_dong' => false,
                    'trans' => false,
                    'fu' => false,
                    'dz' => $this->getMonthDz(),
                    'wx' => $this->getMonthWx(),
                ];
            }
        }


        return array_unique($positions, SORT_REGULAR);
    }

    /**
     * 获取世或者应的六亲
     * @param string $font
     * @return false|int|string
     */
    public function getSixQinByShiOrYing($font = '世')
    {
        $shi_ying = explode(',', $this->resultDiZhi['shi_ying']);
        $six_qin = explode(',', $this->resultDiZhi['liu_qin']);
        $key = array_search($font, $shi_ying);
        return $six_qin[$key];
    }

    /**
     * 通过关键字找汇局
     * @param string $font
     * @return mixed
     */
    public function isHuiJuByFont($font = '财')
    {
        $hui_jus = array_values($this->draw['hui_ju']);
        $row = collect($hui_jus)->where('hui_ju', "汇{$font}局")->first();
        return $row;
    }

    /**
     * 判断五行是否与日令月令五行一致
     * @param $wx
     * @return bool
     */
    public function isEqualDateWx($wx)
    {
        return $wx == $this->getDayWx() || $wx == $this->getMonthWx();
    }

    /**
     * 动爻的化爻的六亲是否等于提供的六亲
     * @param $position
     * @param string $six_qin
     * @return bool
     */
    public function getTranSixQinIsEqualOfferedSixQin($position, $six_qin = '官')
    {
        return $this->getTransSixQinByDongPosition($position) == $six_qin;
    }

    /**
     * 获取动爻对应化爻的六亲
     * @param $position
     * @return mixed
     */
    public function getTransSixQinByDongPosition($position)
    {
        return $this->getTransSixQinByDongYaoPosition($position['position'] ?? '');
    }

    /**
     * 通过动爻的位置获取对应化爻的六亲
     * @param $col_row
     * @return mixed
     */
    public function getTransSixQinByDongYaoPosition($col_row)
    {
        $row = str_split($col_row);
        $arr = $this->getTransArr();
        $transDiZhi = $arr[$row[1] - 1];
        return $this->getSixQinByDz($transDiZhi);
    }

    /**
     * 是否被克，冲，合，或者入墓
     * @param $position
     * @return bool
     */
    public function hasOneKeCongHeRu($position)
    {
        return $this->getIsKeByPosition($position)
            || $this->getIsCongByPosition($position)
            || $this->getIsHeByPosition($position)
            || $this->getIsRuByPosition($position);
    }

    /**
     * 判断某一位置是否被克
     * @param $position
     * @return bool|string
     */
    public function getIsKeByPosition($position)
    {
        $dz = isset($position['dz']) ? $position['dz'] : '';
        $is_dong = isset($position['is_dong']) ? $position['is_dong'] : '';
        $is_an_dong = isset($position['is_an_dong']) ? $position['is_an_dong'] : '';

        $wx = $this->getWxByDz($dz);

        //如果是明动或者暗动
        if ($is_dong || $is_an_dong) {
            return $this->isWithKe($wx);
        }

        //如果是静爻
        return $this->isWithKe($wx, false);
    }

    /**
     * 某一位置的五行是不是被克,默认携带日令月令
     * @param $wx
     * @param bool $date
     * @return bool
     */
    public function isWithKe($wx, $date = true)
    {
        //动爻的五行
        $wxs = $this->getDongYaoWx();

        if ($date) {
            //日令月令的五行
            $date_wxs = $this->getDateWx();

            //通过十二地支去找五行
            $wxs = array_merge($wxs, $date_wxs);
        }

        $wx_ke_me = $this->getWhoKeMe($wx);

        return in_array($wx_ke_me, $wxs);
    }

    /**
     * 判断某一点是不是带冲
     * @param $position
     * @return bool
     */
    public function getIsCongByPosition($position)
    {
        //如果是暗动
        if (isset($position['is_an_dong']) && $position['is_an_dong']) {
            return true;
        }

        //如果是明动，看是否被其他动爻冲或者克
        if (isset($position['is_dong']) && $position['is_dong']) {
            //是不是被冲
            return $this->isWithCong($position['position']);
        }

        //如果是静爻，看是否有动爻冲或者动爻克。
        $position_dz = isset($position['dz']) ? $position['dz'] : '';
        foreach ($this->getDongYaoDz() as $dz) {
            if ($this->isCongRelation($dz, $position_dz)) {
                return true;
            }
        }

        return false;
    }

    /**
     * 判断某一位置是不是冲
     * @param $position
     * @return bool
     */
    public function isWithCong($position)
    {
        $with_cong = false;
        foreach ($this->draw['six_chong'] as $six_chong) {
            if (Str::contains($six_chong, $position)) {
                $with_cong = true;
                break;
            }
        }
        return $with_cong;
    }

    /**
     * 判断某一位置是否合
     * @param $position
     * @param bool $only_date
     * @return bool
     */
    public function getIsHeByPosition($position, $only_date = false)
    {
        foreach ($this->draw['six_he'] as $six_he) {
            if (Str::contains($six_he, $position['position'])) {
                if ($only_date) {
                    if ($this->judgeRelationIsContainsDate($six_he)) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }
        return false;
    }

    public function judgeRelationIsContainsDate($relation)
    {
        $tmp_arr = explode('-', $relation);
        foreach ($tmp_arr as $value) {
            if (Str::startsWith($value, '6')) {
                return true;
            }
        }
        return false;
    }

    /**
     * 判断某一位置是否入墓
     * @param $position
     * @param bool $only_date
     * @return bool
     */
    public function getIsRuByPosition($position, $only_date = false)
    {
        foreach ($this->draw['ru_mu'] as $ru_mu) {
            if (Str::contains($ru_mu, $position['position'])) {
                if ($only_date) {
                    if ($this->judgeRelationIsContainsDate($ru_mu)) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }
        return false;
    }

    public function isRuRelation($position_a, $position_b)
    {
        foreach ($this->draw['ru_mu'] as $ru_mu) {
            if ($ru_mu == $position_a['position'] . '-' . $position_b['position']) {
                return true;
            }
            if ($ru_mu == $position_b['position'] . '-' . $position_a['position']) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $position
     * @return bool
     */
    public function getIsStaticYaoByPosition($position)
    {
        return !$this->getIsDongYaoByPosition($position) && !$this->getIsTransYaoByPosition($position);
    }

    /**
     * @param $position
     * @return bool
     */
    public function getIsDongYaoByPosition($position)
    {
        return ($position['is_dong'] ?? '') || ($position['is_an_dong'] ?? '');
    }

    /**
     * @param $position
     * @return mixed|string
     */
    public function getIsTransYaoByPosition($position)
    {
        return $position['is_trans'] ?? '';
    }

    /**
     * 日月生比
     * @param $wx
     * @return bool
     */
    public function dateGrowEqual($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);

        //月生日生
        if ($grow_me_wx == $this->getDayWx() && $grow_me_wx == $this->getMonthWx()) {
            return true;
        }

        //月生日比旺（相等）
        if ($grow_me_wx == $this->getMonthWx() && $wx == $this->getDayWx()) {
            return true;
        }

        //月比旺日生
        if ($wx == $this->getMonthWx() && $grow_me_wx == $this->getDayWx()) {
            return true;
        }

        //月比旺日比旺
        if ($wx == $this->getMonthWx() && $wx == $this->getDayWx()) {
            return true;
        }

        return false;
    }

    /**
     * 化爻回头生本爻
     * @return bool
     */
    public function getIsTransGrowDong()
    {
        $trans = $this->getTransDetail();
        foreach ($trans as $tran) {
            $ben = collect($this->benGuaDetail)->where('row', $tran['row'])->first();
            if ($this->getWhoGrowMe($this->getWxByDz($tran['dz'])) == $this->getWxByDz($ben['dz'])) {
                return true;
            }
        }
        return false;
    }

     /**
     * > If the position is not a dong and not an an dong, then it is a static trigram
     *
     * @param position the position of the trigram in the hexagram
     * @return  boolean
     */
    public function getIsStaticTrigram($position)
    {
        return $position['is_dong'] == false && $position['is_an_dong'] == false
        && $position['is_trans'] == false && $position['is_volt'] == false;
    }

   /**
    * > This function returns true if the position is a volt
    *
    * @param array The position in the trigram.
    *
    * @return boolean
    */
    public function getIsVoltTrigram($position)
    {
        return $position['is_volt'] == true;
    }

    /**
     * > Get the primary god positions from the font
     *
     * @param string font the font to use
     *
     * @return array
     */
    public function getPrimaryGodPositions($font)
    {
        $positions = $this->getGodPositions($font);
        return $positions[0];
    }

    /**
     * > It checks if only action trigram grow current position
     *
     * @param array $position
     * @return boolean
     */
    public function onlyDongYaoGrowMe($position)
    {
        return $this->getIsDongYaoGrowMe($position['wx'])
        && !$this->getIsDateGrowMe($position['wx'])
        && !$this->getIsTransGrowMe($position)
        && !$this->getIsStaticYaoGrowMe($position['wx']);
    }

    /**
     * It checks if only current column grow current position
     *
     * @param array $position
     * @return boolean
     */
    public function onlyBenYaoGrowMe($position)
    {
        return ($this->getIsDongYaoGrowMe($position['wx']) || $this->getIsStaticYaoGrowMe($position['wx']))
        && !$this->getIsDateGrowMe($position['wx'])
        && !$this->getIsTransGrowMe($position);
    }


    /**
     * It checks if the position is a trans grow me position.
     *
     * @param array The position in the trigrams
     * @return boolean
     */
    public function getIsTransGrowMe($position)
    {
        $wx = $position['wx'];
        $grow_wx = $this->getWhoGrowMe($wx);

        $trans = $this->getTransDetail();

        $row = substr($position['position'],-1);
        $tran = collect($trans)->where('row',$row)->first();

        if($tran){
            $wx = $this->getWxByDz($tran['dz']);
            return $wx == $grow_wx;
        }

        return false;
    }

}