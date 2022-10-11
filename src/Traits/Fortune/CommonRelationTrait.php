<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

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
     * 判断某一位置是否被克
     * @param $position
     * @return bool|string
     */
    public function getIsKeByPosition($position)
    {
        $wx = $this->getWxByDz($position['dz']);

        //如果是明动或者暗动
        if ($position['is_dong'] || $position['is_an_dong']) {
            return $this->isWithKe($wx);
        }

        //如果是静爻
        return $this->isWithKe($wx, false);
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
     * 判断某一点是不是带冲
     * @param $position
     * @return bool
     */
    public function getIsCongByPosition($position)
    {
        //如果是暗动
        if ($position['is_an_dong']) {
            return true;
        }

        //如果是明动，看是否被其他动爻冲或者克
        if ($position['is_dong']) {
            //是不是被冲
            return $this->isWithCong($position['position']);
        }

        //如果是静爻，看是否有动爻冲或者动爻克。
        foreach ($this->getDongYaoDz() as $dz) {
            if ($this->isCongRelation($dz, $position['dz'])) {
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
     * 判断某一位置是否入墓
     * @param $position
     * @return bool
     */
    public function getIsRuByPosition($position)
    {
        foreach ($this->draw['ru_mu'] as $ru_mu) {
            if (Str::contains($ru_mu, $position['position'])) {
                return true;
            }
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
     * 判断某一位置是否合
     * @param $position
     * @return bool
     */
    public function getIsHeByPosition($position)
    {
        foreach ($this->draw['six_he'] as $six_he) {
            if (Str::contains($six_he, $position['position'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * 通过六亲找到对应的位置
     * @param $six_qin
     * @return array
     */
    public function getPositionsWithSixQin($six_qin)
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
                    'dz' => $this->benGuaDetail[$key]['dz'],
                    'wx' => $this->getWxByDz($this->benGuaDetail[$key]['dz']),
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
                    'dz' => $dz,
                    'wx' => $this->getWxByDz($dz),
                ];
            }
        }

        return array_unique($positions,SORT_REGULAR);
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
        $arr = array_combine($six_qin, $shi_ying);
        return array_search($font, $arr);
    }

    /**
     * 通过关键字找汇局
     * @param string $font
     * @return mixed
     */
    public function isHuiJuByFont($font = '财')
    {
        $hui_jus = array_values($this->draw['hui_ju']);
        $row = collect($hui_jus)->where('hui_ju',"汇{$font}局")->first();
        return $row;
    }

    /**
     * 判断五行是否与日令月令五行一致
     * @param $wx
     * @return bool
     */
    public function isEqualDateWx($wx)
    {
        return in_array($wx,$this->getDateWx());
    }
}