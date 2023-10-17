<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait CommonRelationTrait
{
    /**
     * It sets the god positions.
     *
     * @param positions An array of positions.
     */
    public function setGodPositions($positions)
    {
        $this->god_positions = $positions;
    }


    /**
     * > Get the first god's WeChat ID
     *
     * @return The first element of the god_positions array.
     */
    public function getGodWx()
    {
        $position = $this->god_positions[0];
        return $position['wx'] ?? null;
    }


    /**
     * > If the user is in the list of users who have a date with me, return true
     *
     * @param wx the wechat id of the person who sent the message
     * @return boolean
     */
    public function isWithDateKe($wx)
    {
        $wxs = $this->getDateWx();

        $wx_ke_me = $this->getWhoKeMe($wx);

        return in_array($wx_ke_me, $wxs);
    }


    /**
     * It returns the day and month of the date.
     *
     * @return The day and month of the date.
     */
    public function getDateWx()
    {
        return [
            $this->getDayWx(),
            $this->getMonthWx(),
        ];
    }


    public function getDayWx()
    {
        return $this->getWxByDz($this->getDayDz());
    }


    /**
     * It returns the weather station code for a given location.
     *
     * @param dz the address of the device
     *
     * @return The weather condition for the given zip code.
     */
    public function getWxByDz($dz)
    {
        $dz_wx = collect($this->dzWx)->where('dz', $dz)->first();
        return $dz_wx['wx'];
    }


    /**
     * It returns the day dizhi.
     *
     * @return The day of the week.
     */
    public function getDayDz()
    {
        return $this->diZhiDay;
    }


    /**
     * It returns the month's wx.
     *
     * @return The month's weather.
     */
    public function getMonthWx()
    {
        return $this->getWxByDz($this->getMonthDz());
    }


    public function getMonthDz()
    {
        return $this->diZhiMonth;
    }


    /**
     * It returns the day and month of the date.
     *
     * @return The day and month of the date.
     */
    public function getDateDz()
    {
        return [
            $this->getDayDz(),
            $this->getMonthDz(),
        ];
    }

    public function getIsDongAndTransYaoGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        $wxs = array_merge($this->getDongYaoWx(), $this->getTransYaoWx());
        return in_array($grow_me_wx, $wxs);
    }

    /**
     * It returns the wx of the dongyao.
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

    public function getDongYaoDz()
    {
        $dong_yao = $this->getDongYao();
        return $dong_yao->pluck('dz')->toArray();
    }

    public function getDongYao()
    {
        return collect($this->benGuaDetail)->filter(function ($item, $key) {
            return $item['is_dong'] || $item['is_an_dong'];
        });
    }

    public function getTransYaoWx()
    {
        $trans_dzs = $this->getTransYaoDz();
        $trans_wxs = [];
        foreach ($trans_dzs as $trans_dz) {
            $trans_wxs[] = $this->getWxByDz($trans_dz);
        }
        return $trans_wxs;
    }

    public function getTransYaoDz()
    {
        return collect($this->getTransDetail())->pluck('dz')->toArray();
    }

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

    public function getTransArr()
    {
        return array_reverse(explode(',', $this->resultDiZhi['trans_di_zhi']));
    }

    public function withoutHeOrRuByGrowMe($wx)
    {
        $result = false;
        $grow_me_wx = $this->getWhoGrowMe($wx);

        foreach ($this->getDongYao() as $yao) {
            if ($grow_me_wx == $this->getWxByDz($yao['dz'])) {
                $position = $yao['column'] . $yao['row'];

                if ($this->isWithHe($position)) {
                    $result = true;
                    break;
                }

                if ($this->isWithRu($position)) {
                    $result = true;
                    break;
                }
            }
        }

        return $result;
    }

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

    public function getIsKongWangByPosition($position)
    {
        $coords = $this->draw['kong_wang']['coords'];

        foreach ($coords as $coord) {
            return $coord['position'] == $position['position'];
        }

        return false;
    }

    public function getPositionsWhoGrowMe($wx)
    {
        $wx_grow_me = $this->getWhoGrowMe($wx);
        $positions = [];
        foreach ($this->getDongYao() as $yao) {
            if ($wx_grow_me == $this->getWxByDz($yao['dz'])) {
                $positions[] = [
                    'position' => $yao['column'] . $yao['row'],
                    'is_dong' => $yao['is_dong'],
                    'is_an_dong' => $yao['is_an_dong'],
                    'dz' => $yao['dz'],
                    'wx' => $this->getWxByDz($yao['dz']),
                ];
            }
        }

        foreach ($this->getTransDetail() as $yao) {
            if ($wx_grow_me == $this->getWxByDz($yao['dz'])) {
                $positions[] = [
                    'position' => $yao['column'] . $yao['row'],
                    'is_dong' => $yao['is_dong'],
                    'is_an_dong' => $yao['is_an_dong'],
                    'dz' => $yao['dz'],
                    'wx' => $this->getWxByDz($yao['dz']),
                ];
            }
        }

        return $positions;
    }

    public function getPositionsWithSixQin($six_qin, $contain_date = false)
    {
        $positions = [];

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

    public function getSixQinByShiOrYing($font = '世')
    {
        $shi_ying = explode(',', $this->resultDiZhi['shi_ying']);
        $six_qin = explode(',', $this->resultDiZhi['liu_qin']);
        $key = array_search($font, $shi_ying);
        return $six_qin[$key];
    }

    public function isHuiJuByFont($font = '财')
    {
        $hui_jus = array_values($this->draw['hui_ju']);
        $row = collect($hui_jus)->where('hui_ju', "汇{$font}局")->first();
        return $row;
    }

    public function isEqualDateWx($wx)
    {
        return $wx == $this->getDayWx() || $wx == $this->getMonthWx();
    }

    public function getTranSixQinIsEqualOfferedSixQin($position, $six_qin = '官')
    {
        return $this->getTransSixQinByDongPosition($position) == $six_qin;
    }

    public function getTransSixQinByDongPosition($position)
    {
        return $this->getTransSixQinByDongYaoPosition($position['position'] ?? '');
    }

    public function getTransSixQinByDongYaoPosition($col_row)
    {
        $row = str_split($col_row);
        $arr = $this->getTransArr();
        $transDiZhi = $arr[$row[1] - 1];
        return $this->getSixQinByDz($transDiZhi);
    }

    public function hasOneKeCongHeRu($position)
    {
        return $this->getIsKeByPosition($position)
            || $this->getIsCongByPosition($position)
            || $this->getIsHeByPosition($position)
            || $this->getIsRuByPosition($position);
    }

    public function getIsKeByPosition($position)
    {
        $dz = isset($position['dz']) ? $position['dz'] : '';
        $is_dong = isset($position['is_dong']) ? $position['is_dong'] : '';
        $is_an_dong = isset($position['is_an_dong']) ? $position['is_an_dong'] : '';

        $wx = $this->getWxByDz($dz);

        $is_volt = isset($position['is_volt']) ? $position['is_volt'] : '';
        if ($is_volt) {
            if ($is_dong || $is_an_dong) {
                $ben_yao = collect($this->benGuaDetail)
                    ->where('column', $position['position'][0])
                    ->where('row', $position['position'][1])
                    ->first();
                $wx_ke_me = $this->getWhoKeMe($wx);
                return $this->getWxByDz($ben_yao['dz']) == $wx_ke_me;
            }
        }

        if ($is_dong || $is_an_dong) {
            return $this->isWithKe($wx);
        }

        return $this->isWithKe($wx, false);
    }

    public function isWithKe($wx, $date = true)
    {
        $wxs = $this->getDongYaoWx();

        if ($date) {
            $date_wxs = $this->getDateWx();
            $wxs = array_merge($wxs, $date_wxs);
        }

        $wx_ke_me = $this->getWhoKeMe($wx);

        return in_array($wx_ke_me, $wxs);
    }

    public function getIsCongByPosition($position)
    {
        $is_dong = isset($position['is_dong']) ? $position['is_dong'] : '';
        $is_an_dong = isset($position['is_an_dong']) ? $position['is_an_dong'] : '';
        if ($is_an_dong) {
            return true;
        }

        $is_volt = isset($position['is_volt']) ? $position['is_volt'] : '';
        if ($is_volt) {
            if ($is_dong || $is_an_dong) {
                $ben_yao = collect($this->benGuaDetail)
                    ->where('column', $position['position'][0])
                    ->where('row', $position['position'][1])
                    ->first();
                return $this->isCongRelation($position['dz'], $ben_yao['dz']);
            }
        }

        if (isset($position['is_dong']) && $position['is_dong']) {
            return $this->isWithCong($position['position']);
        }

        $position_dz = isset($position['dz']) ? $position['dz'] : '';
        foreach ($this->getDongYaoDz() as $dz) {
            if ($this->isCongRelation($dz, $position_dz)) {
                return true;
            }
        }

        return false;
    }

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

    public function getIsHeByPosition($position, $only_date = false)
    {
        $is_dong = isset($position['is_dong']) ? $position['is_dong'] : '';
        $is_an_dong = isset($position['is_an_dong']) ? $position['is_an_dong'] : '';
        $is_volt = isset($position['is_volt']) ? $position['is_volt'] : '';
        if ($is_volt) {
            if ($is_dong || $is_an_dong) {
                $ben_yao = collect($this->benGuaDetail)
                    ->where('column', $position['position'][0])
                    ->where('row', $position['position'][1])
                    ->first();
                return $this->isHeRelation($position['dz'], $ben_yao['dz']);
            }
        }

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

    public function getIsStaticYaoByPosition($position)
    {
        return !$this->getIsDongYaoByPosition($position) && !$this->getIsTransYaoByPosition($position);
    }

    public function getIsDongYaoByPosition($position)
    {
        return ($position['is_dong'] ?? '') || ($position['is_an_dong'] ?? '');
    }

    public function getIsTransYaoByPosition($position)
    {
        return $position['is_trans'] ?? '';
    }

    public function dateGrowEqual($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);

        if ($grow_me_wx == $this->getDayWx() || $grow_me_wx == $this->getMonthWx()) {
            return true;
        }

        if ($wx == $this->getMonthWx() || $wx == $this->getDayWx()) {
            return true;
        }

        return false;
    }

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
     * > It returns true if the person who grew me is in the list of people who are Dong Yao
     *
     * @param wx the user's wechat id
     */
    public function getIsDongYaoGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        return in_array($grow_me_wx, $this->getDongYaoWx());
    }

    public function getIsDateGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        return in_array($grow_me_wx, $this->getDateWx());
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

        $row = substr($position['position'], -1);
        $tran = collect($trans)->where('row', $row)->first();

        if ($tran) {
            $wx = $this->getWxByDz($tran['dz']);
            return $wx == $grow_wx;
        }

        return false;
    }

    public function getIsStaticYaoGrowMe($wx)
    {
        $grow_me_wx = $this->getWhoGrowMe($wx);
        return in_array($grow_me_wx, $this->getStaticYaoWx());
    }

    /**
     * It returns the static yao wx.
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

    public function getStaticYaoDz()
    {
        $static_yao = $this->getStaticYao();
        return $static_yao->pluck('dz')->toArray();
    }

    public function getStaticYao()
    {
        return collect($this->benGuaDetail)->filter(function ($item, $key) {
            return $item['is_dong'] == false && $item['is_an_dong'] == false;
        });
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
     * The function "getKeRelations" takes an array of "wxs" and compares each element with another
     * array "compare", returning an array of pairs where the element from "wxs" is found in "compare".
     *
     * @param wxs An array of values representing "wxs".
     * @param compare The "compare" parameter is an array that contains the values to compare against
     * the values in the "" array.
     *
     * @return an array of arrays. Each inner array contains two elements: the first element is the
     * value of `` and the second element is the value of ``.
     */
    public function getKeRelations($wxs, $compare)
    {
        $res = [];

        foreach ($wxs as $me) {
            $wx = $this->getWhoKeMe($me);
            if (in_array($wx, $compare)) {
                $res[] = [$wx, $me];
            }
        }

        return $res;
    }

    /**
     * The function "getKeDongByTrans" retrieves pairs of values from two different arrays based on
     * specific conditions.
     *
     * @return an array of arrays. Each inner array contains two elements: the first element is the
     * value of the variable , and the second element is the value of the variable .
     */
    public function getKeDongByTrans()
    {
        $res = [];

        $dong_positions = $this->getBenDong();

        $trans_positions = $this->getAllHuaPositions();

        foreach ($dong_positions as $dong_position) {
            $me = $this->getWxByDz($dong_position['dz']);
            $trans_position = collect($trans_positions)->where('row', $dong_position['row'])->first();
            if ($trans_position) {
                $wx = $this->getWhoKeMe($me);
                if ($wx == $this->getWxByDz($trans_position['dz'])) {
                    $res[] = [$wx, $me];
                }
            }
        }

        return $res;
    }

    /**
     * The function "getHuiJuWx" returns an array of unique "hui_wx" values from a nested array called
     * "hui_ju".
     *
     * @return an array of unique values from the "hui_wx" key in the "hui_ju" array.
     */
    public function getHuiJuWx()
    {
        $wxs = [];
        $hui_jus = $this->draw['hui_ju'];
        foreach ($hui_jus as $hui_ju) {
            $wx = collect($hui_ju)->pluck('hui_wx')->toArray();
            $wxs = array_merge($wxs, $wx);
        }
        return array_unique($wxs);
    }
}
