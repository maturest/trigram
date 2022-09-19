<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait DissolveTrait
{
    public function dissolve($year, $is_pregnant = false)
    {
        $res = [];

        //拜神
        $res[] = $this->baiWho($year);

        //卜月运势卦
        $res[] = $this->fortuneTrigram();

        //是否需要卜出行卦
        $res[] = $this->tripTrigram();

        //净化磁场
        $res[] = $this->cleanMagneticField();

        //让婴灵去报道
        $res[] = $this->unborn($is_pregnant);

        return array_filter($res);
    }

    /**
     * 拜神
     * @return mixed
     */
    public function baiWho($year)
    {
        $letters = [
            ['wx' => '火', 'is_cong' => false, 'bai' => '朝东拜神农大帝???保佑?运势平安'],
            ['wx' => '土', 'is_cong' => false, 'bai' => '朝南拜关圣帝君???保佑?运势平安'],
            ['wx' => '金', 'is_cong' => false, 'bai' => '朝西拜地藏王菩萨???保佑?运势平安'],
            ['wx' => '金', 'is_cong' => true, 'bai' => '朝西拜观世音菩萨???保佑?运势平安'],
            ['wx' => '水', 'is_cong' => false, 'bai' => '朝西拜观世音菩萨???保佑?运势平安'],
            ['wx' => '水', 'is_cong' => true, 'bai' => '朝北拜玄天上帝???保佑?运势平安'],
            ['wx' => '木', 'is_cong' => false, 'bai' => '朝北拜玄天上帝???保佑?运势平安'],
        ];

        $wx = $this->getGodWx();
        $is_cong = false;

        if (in_array($wx, ['金', '水'])) {
            // 判断用神是否带冲
            $is_cong = $this->getIsCongByPosition($this->god_positions[0]);
        }

        $row = collect($letters)->where('wx', $wx)->where('is_cong', $is_cong)->first();

        return Str::replaceArray('?', $this->getConditions($year), $row['bai']);
    }

    /**
     * 获取条件数组
     * @param $year
     * @return array
     */
    public function getConditions($year)
    {
        $res = [];
        $god_wx = $this->getGodWx();
        //条件一
        $res[] = $this->getHuaSha($god_wx);
        //条件二
        $res[] = $this->getWholeFortune();
        //条件三
        $res[] = $this->getMagnatePower($god_wx);
        //条件四 年份
        $res[] = $year;

        return $res;
    }

    /**
     * 获取化煞内容
     * @param $god_wx
     * @return string
     */
    public function getHuaSha($god_wx)
    {
        //化煞1
        $hua_sha[] = $this->getHuaSha1($god_wx);
        //化煞2
        $hua_sha[] = $this->getHuaSha2($god_wx);

        return implode(',', array_filter(array_unique($hua_sha,SORT_REGULAR)));
    }

    public function getHuaSha1($god_wx)
    {
        $position = $this->god_positions[0];

        //用神爻是否被动爻或者日令月令克
        $is_ke_god = $this->getIsKeByPosition($position);

        if ($is_ke_god) {
            //用神爻被动爻生 && 生世爻的爻不带合或入
            $shi_position = $this->getShiOrYingPosition();
            if ($this->getIsDongYaoGrowMe($god_wx) && $this->withoutHeOrRuByGrowMe($shi_position['wx'])) {
                return '';
            } else {
                return $this->getHuaShaByWx($god_wx);
            }
        } else {
            return $this->getHuaShaByWx($god_wx);
        }
    }

    /**
     * 获取化煞结果
     * @param $god_wx
     * @return mixed
     */
    public function getHuaShaByWx($god_wx)
    {
        $letters = [
            ['wx' => '木', 'hs' => '化金煞',],
            ['wx' => '火', 'hs' => '化水煞',],
            ['wx' => '土', 'ke' => true, 'cong' => false, 'hs' => '化木煞',],
            ['wx' => '土', 'ke' => false, 'cong' => true, 'hs' => '化土煞',],
            ['wx' => '土', 'ke' => true, 'cong' => true, 'hs' => '化土煞、木煞',],
            ['wx' => '金', 'ke' => true, 'cong' => false, 'hs' => '化火煞',],
            ['wx' => '金', 'ke' => false, 'cong' => true, 'hs' => '化木煞',],
            ['wx' => '金', 'ke' => true, 'cong' => true, 'hs' => '化木煞、火煞',],
            ['wx' => '水', 'ke' => true, 'cong' => false, 'hs' => '化土煞',],
            ['wx' => '水', 'ke' => false, 'cong' => true, 'hs' => '化火煞',],
            ['wx' => '水', 'ke' => true, 'cong' => true, 'hs' => '化火煞、土煞',],

        ];

        if (in_array($god_wx, ['木', '火'])) {
            $row = collect($letters)->where('wx', $god_wx)->first();
            return $row['hs'];
        }

        // 世爻的位置
        $shi_position = $this->getShiOrYingPosition();
        // 判断世爻是否被冲
        $is_cong = $this->getIsCongByPosition($shi_position['position']);
        // 判断世爻是否被克
        $is_ke = $this->getIsKeByPosition($shi_position['position']);

        $row = collect($letters)->where('wx', $god_wx)->where('ke', $is_ke)->where('cong', $is_cong)->first();

        return $row['hs'];
    }

    /**
     * 动爻的冲克包含动爻与日月的关系，静爻的冲克仅考虑动爻的关系
     * @param $god_wx
     * @return string
     */
    public function getHuaSha2($god_wx)
    {
        //用神有动爻冲或有动爻克
        $god_position = $this->god_positions[0];

        //如果是暗动
        if ($god_position['is_an_dong']) {
            return $this->getHuaShaByWx($god_wx);
        }

        //如果是明动，看是否被其他动爻冲或者克
        if ($god_position['is_dong']) {
            //是不是被冲
            if ($this->isWithCong($god_position['position'])) {
                return $this->getHuaShaByWx($god_wx);
            }
            //是不是被克
            if ($this->isWithKe($god_wx)) {
                return $this->getHuaShaByWx($god_wx);
            };
        }

        //如果是静爻，看是否有动爻冲或者动爻克。
        foreach ($this->getDongYaoDz() as $dz) {
            if ($this->isCongRelation($dz, $god_position['dz'])) {
                return $this->getHuaShaByWx($god_wx);
            }
        }

        if ($this->isWithKe($god_wx, false)) {
            return $this->getHuaShaByWx($god_wx);
        }

        return '';
    }

    /**
     * 增强个人整体运势
     * @return string
     */
    public function getWholeFortune()
    {
        //用神空亡，入墓，合
        $position = $this->god_positions[0];

        if ($this->getIsKongWangByPosition($position)
            || $this->getIsRuByPosition($position)
            || $this->getIsHeByPosition($position)) {
            return '增强个人整体运势';
        }

        return '';
    }

    /**
     * 加强贵人力量
     * @param $god_wx
     * @return string
     */
    public function getMagnatePower($god_wx)
    {
        //生用神的爻的位置
        $positions = $this->getPositionsWhoGrowMe($god_wx);
        foreach ($positions as $position) {
            if ($this->getIsKongWangByPosition($position)
                || $this->getIsRuByPosition($position)
                || $this->getIsHeByPosition($position)) {
                return '加强贵人力量';
            }
        }
        return '';
    }

    /**
     * 月运势卦
     * @param $god
     * @return mixed
     */
    public function fortuneTrigram()
    {
        $letters = [
            ['wx' => '木', 'letter' => '建议您在申月、酉月卜当月运势卦'],
            ['wx' => '火', 'letter' => '建议您在亥月、子月卜当月运势卦'],
            ['wx' => '土', 'letter' => '建议您在寅月、卯月卜当月运势卦'],
            ['wx' => '金', 'letter' => '建议您在巳月、午月卜当月运势卦'],
            ['wx' => '水', 'letter' => '建议您在丑月、辰月、未月、戌月卜当月运势卦'],
        ];

        $row = collect($letters)->where('wx', $this->getGodWx())->first();

        return $row['letter'];
    }

    /**
     * 出行卦
     * 父爻的五行是动爻，并且被克，被冲或入墓
     * @param string $six_qin
     * @return string
     */
    public function tripTrigram($six_qin = '父')
    {
        $positions = $this->getPositionsWithSixQin($six_qin);
        foreach ($positions as $position) {
            if ($position['is_dong'] || $position['is_an_dong']) {
                if ($this->getIsKeByPosition($position) || $this->getIsCongByPosition($position) || $this->getIsRuByPosition($position)) {
                    return '建议您出远门卜出行卦，注意交通工具安全，避免疲劳驾驶';
                }
            }
        }

        return '';
    }

    /**
     * 净化磁场
     * @return string
     */
    public function cleanMagneticField()
    {
        $six_qin_ying = $this->getSixQinByShiOrYing('应');
        $six_qin_shi = $this->getSixQinByShiOrYing('世');

        if ($six_qin_ying == '官' && in_array($six_qin_shi, ['兄', '子', '财', '官'])) {
            return '建议您卜卦择日净化住家磁场';
        }

        if ($six_qin_ying == '兄' && in_array($six_qin_shi, ['兄', '财', '官', '父'])) {
            return '建议您卜卦择日净化住家磁场';
        }

        return '';
    }

    /**
     * 婴灵
     * 官是动爻并且与动爻的兄或子有合、冲、入，克关系
     * @param $is_pregnant
     * @return string
     */
    public function unborn($is_pregnant)
    {
        $guan_positions = $this->getPositionsWithSixQin('官');
        $brother_positions = $this->getPositionsWithSixQin('兄');
        $child_positions = $this->getPositionsWithSixQin('子');

        if (!$is_pregnant) {
            foreach ($guan_positions as $position) {
                //如果官爻是动爻
                if ($position['is_dong'] || $position['is_an_dong']) {

                    //判断是否有合的关系
                    if ($this->getIsHeByPosition($position)) {
                        if ($this->isNeedUnborn($position, $brother_positions, 'six_he')
                            || $this->isNeedUnborn($position, $child_positions, 'six_he')) {
                            return $this->cleanYinQi();
                        }
                    }

                    //判断是否有冲的关系
                    if ($this->getIsCongByPosition($position)) {
                        if ($this->isNeedUnborn($position, $brother_positions, 'six_chong')
                            || $this->isNeedUnborn($position, $child_positions, 'six_chong')) {
                            return $this->cleanYinQi();
                        }
                    }

                    //判断是否有入的关系
                    if ($this->getIsRuByPosition($position)) {
                        if ($this->isNeedUnborn($position, $brother_positions, 'ru_mu')
                            || $this->isNeedUnborn($position, $child_positions, 'ru_mu')) {
                            return $this->cleanYinQi();
                        }
                    }

                    //判断是否有克的关系
                    if ($this->unbornKe($position, $brother_positions) || $this->unbornKe($position, $child_positions)) {
                        return $this->cleanYinQi();
                    }
                }
            }
        }

        return '';
    }

    /**
     * @param array $position 官动爻的位置
     * @param array $relation_positions 六亲的位置
     * @param string $relation 关系
     * @return bool
     */
    public function isNeedUnborn($position, $relation_positions, $relation = 'six_he')
    {
        foreach ($this->draw[$relation] as $item) {
            $tmp_arr = explode('-', $item);
            if (in_array($position['position'], $tmp_arr)) {
                $tmp_arr = array_diff($tmp_arr, [$position['position']]);
                foreach ($relation_positions as $relation_position) {
                    if (in_array($relation_position['position'], $tmp_arr) && ($relation_position['is_dong'] || $relation_position['is_an_dong'])) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * 请走婴灵
     * @return mixed
     */
    public function cleanYinQi()
    {
        $zi_positions = $this->getPositionsWithSixQin('子');

        $letters = [
            ['wx' => '木', 'letter' => '建议您去庙里拜神农大帝让婴灵去报到。如不方便去庙里，可在安静的地方朝东拜神农大帝化土煞或者化身边的阴气'],
            ['wx' => '火', 'letter' => '建议您去庙里拜关圣帝君让婴灵去报到。如不方便去庙里，可在安静的地方朝南拜关圣帝君化金煞或者化身边的阴气'],
            ['wx' => '土', 'letter' => '建议您去庙里拜地藏王菩萨让婴灵去报到。如不方便去庙里，可在安静的地方朝西拜地藏王菩萨化水煞或者化身边的阴气'],
            ['wx' => '金', 'letter' => '建议您去庙里拜观世音菩萨让婴灵去报到。如不方便去庙里，可在安静的地方朝西拜观世音菩萨化木煞或者化身边的阴气'],
            ['wx' => '水', 'letter' => '建议您去庙里拜玄天上帝让婴灵去报到。如不方便去庙里，可在安静的地方朝北拜玄天上帝化火煞或者化身边的阴气'],
        ];

        $row = collect($letters)->where('wx', $zi_positions[0]['wx'])->first();

        return $row['letter'];
    }

    /**
     * 官爻的位置是否与兄或者子动爻相克
     * @param $position
     * @param $relation_positions
     */
    public function unbornKe($position, $relation_positions)
    {
        $wx = $this->getWxByDz($position['dz']);
        $wx_ke_me = $this->getWhoKeMe($wx);
        foreach ($relation_positions as $relation_position) {
            //如果是动爻
            if ($relation_position['is_dong'] || $relation_position['is_an_dong']) {
                if ($this->getWxByDz($relation_position['dz']) == $wx_ke_me) {
                    return true;
                }
            }
        }
        return false;
    }
}