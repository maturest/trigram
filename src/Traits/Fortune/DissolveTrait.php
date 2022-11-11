<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait DissolveTrait
{
    public function dissolve($year, $is_pregnant = false)
    {
        $res = [];

        $res[] = $this->baiWho($year);

        $res[] = $this->fortuneTrigram();

        $res[] = $this->tripTrigram();

        $res[] = $this->cleanMagneticField();

        $res[] = $this->unborn($is_pregnant);

        return array_filter($res);
    }


    public function baiWho($year)
    {
        $letters = [
            ['wx' => '火', 'is_cong' => false, 'bai' => '朝东拜神农大帝，???保佑?运势平安。'],
            ['wx' => '土', 'is_cong' => false, 'bai' => '朝南拜关圣帝君，???保佑?运势平安。'],
            ['wx' => '金', 'is_cong' => false, 'bai' => '朝西拜地藏王菩萨，???保佑?运势平安。'],
            ['wx' => '金', 'is_cong' => true, 'bai' => '朝西拜观世音菩萨，???保佑?运势平安。'],
            ['wx' => '水', 'is_cong' => false, 'bai' => '朝西拜观世音菩萨，???保佑?运势平安。'],
            ['wx' => '水', 'is_cong' => true, 'bai' => '朝北拜玄天上帝，???保佑?运势平安。'],
            ['wx' => '木', 'is_cong' => false, 'bai' => '朝北拜玄天上帝，???保佑?运势平安。'],
        ];

        $wx = $this->getGodWx();
        $is_cong = false;

        if (in_array($wx, ['金', '水'])) {
            $is_cong = $this->getIsCongByPosition($this->god_positions[0]);
        }

        $row = collect($letters)->where('wx', $wx)->where('is_cong', $is_cong)->first();

        return Str::replaceArray('?', $this->getConditions($year), $row['bai']);
    }

    public function getConditions($year)
    {
        $res = [];
        $god_wx = $this->getGodWx();

        $res[] = $this->getHuaSha($god_wx);

        $res[] = $this->getWholeFortune();

        $res[] = $this->getMagnatePower($god_wx);

        $res[] = $year;

        return $res;
    }

    public function getHuaSha($god_wx)
    {
        $hua_sha[] = $this->getHuaSha1($god_wx);

        $hua_sha[] = $this->getHuaSha2($god_wx);

        $str = implode(',', array_filter(array_unique($hua_sha, SORT_REGULAR)));

        if ($str) {
            return $str . '，';
        }

        return '';
    }

    public function getHuaSha1($god_wx)
    {
        $position = $this->god_positions[0];

        $is_ke_god = $this->getIsKeByPosition($position);

        if ($is_ke_god) {
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

        $shi_position = $this->getShiOrYingPosition();
        $is_cong = $this->getIsCongByPosition($shi_position['position']);
        $is_ke = $this->getIsKeByPosition($shi_position['position']);

        $row = collect($letters)->where('wx', $god_wx)->where('ke', $is_ke)->where('cong', $is_cong)->first();

        return $row['hs'];
    }

    public function getHuaSha2($god_wx)
    {
        $god_position = $this->god_positions[0];

        if ($god_position['is_an_dong']) {
            return $this->getHuaShaByWx($god_wx);
        }

        if ($god_position['is_dong']) {
            if ($this->isWithCong($god_position['position'])) {
                return $this->getHuaShaByWx($god_wx);
            }

            if ($this->isWithKe($god_wx)) {
                return $this->getHuaShaByWx($god_wx);
            }
        }

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

    public function getWholeFortune()
    {
        $position = $this->god_positions[0];

        if ($this->getIsKongWangByPosition($position)
            || $this->getIsRuByPosition($position)
            || $this->getIsHeByPosition($position)) {
            return '增强个人整体运势，';
        }

        return '';
    }

    public function getMagnatePower($god_wx)
    {
        $positions = $this->getPositionsWhoGrowMe($god_wx);
        foreach ($positions as $position) {
            if ($this->getIsKongWangByPosition($position)
                || $this->getIsRuByPosition($position)
                || $this->getIsHeByPosition($position)) {
                return '加强贵人力量，';
            }
        }
        return '';
    }

    public function fortuneTrigram()
    {
        $letters = [
            ['wx' => '木', 'letter' => '建议您在申月、酉月卜当月运势卦。'],
            ['wx' => '火', 'letter' => '建议您在亥月、子月卜当月运势卦。'],
            ['wx' => '土', 'letter' => '建议您在寅月、卯月卜当月运势卦。'],
            ['wx' => '金', 'letter' => '建议您在巳月、午月卜当月运势卦。'],
            ['wx' => '水', 'letter' => '建议您在丑月、辰月、未月、戌月卜当月运势卦。'],
        ];

        $row = collect($letters)->where('wx', $this->getGodWx())->first();

        return $row['letter'];
    }

    public function tripTrigram($six_qin = '父')
    {
        $positions = $this->getPositionsWithSixQin($six_qin);
        foreach ($positions as $position) {
            if ($position['is_dong'] || $position['is_an_dong']) {
                if ($this->getIsKeByPosition($position) || $this->getIsCongByPosition($position) || $this->getIsRuByPosition($position)) {
                    return '建议您出远门卜出行卦，注意交通工具安全，避免疲劳驾驶。';
                }
            }
        }

        return '';
    }

    public function cleanMagneticField()
    {
        $six_qin_ying = $this->getSixQinByShiOrYing('应');
        $six_qin_shi = $this->getSixQinByShiOrYing('世');

        if ($six_qin_ying == '官' && in_array($six_qin_shi, ['兄', '子', '财', '官'])) {
            return '建议您卜卦择日净化住家磁场。';
        }

        if ($six_qin_ying == '兄' && in_array($six_qin_shi, ['兄', '财', '官', '父'])) {
            return '建议您卜卦择日净化住家磁场。';
        }

        return '';
    }

    public function unborn($is_pregnant)
    {
        $guan_positions = $this->getPositionsWithSixQin('官');
        $brother_positions = $this->getPositionsWithSixQin('兄');
        $child_positions = $this->getPositionsWithSixQin('子');

        if (!$is_pregnant) {
            foreach ($guan_positions as $position) {

                if ($position['is_dong'] || $position['is_an_dong']) {
                    if ($this->getIsHeByPosition($position)) {
                        if ($this->isNeedUnborn($position, $brother_positions, 'six_he')
                            || $this->isNeedUnborn($position, $child_positions, 'six_he')) {
                            return $this->cleanYinQi();
                        }
                    }

                    if ($this->getIsCongByPosition($position)) {
                        if ($this->isNeedUnborn($position, $brother_positions, 'six_chong')
                            || $this->isNeedUnborn($position, $child_positions, 'six_chong')) {
                            return $this->cleanYinQi();
                        }
                    }

                    if ($this->getIsRuByPosition($position)) {
                        if ($this->isNeedUnborn($position, $brother_positions, 'ru_mu')
                            || $this->isNeedUnborn($position, $child_positions, 'ru_mu')) {
                            return $this->cleanYinQi();
                        }
                    }

                    if ($this->unbornKe($position, $brother_positions) || $this->unbornKe($position, $child_positions)) {
                        return $this->cleanYinQi();
                    }
                }
            }
        }

        return '';
    }

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

    public function cleanYinQi()
    {
        $zi_positions = $this->getPositionsWithSixQin('子');

        $letters = [
            ['wx' => '木', 'letter' => '建议您去庙里拜神农大帝让婴灵去报到。如不方便去庙里，可在安静的地方朝东拜神农大帝化土煞或者化身边的阴气。'],
            ['wx' => '火', 'letter' => '建议您去庙里拜关圣帝君让婴灵去报到。如不方便去庙里，可在安静的地方朝南拜关圣帝君化金煞或者化身边的阴气。'],
            ['wx' => '土', 'letter' => '建议您去庙里拜地藏王菩萨让婴灵去报到。如不方便去庙里，可在安静的地方朝西拜地藏王菩萨化水煞或者化身边的阴气。'],
            ['wx' => '金', 'letter' => '建议您去庙里拜观世音菩萨让婴灵去报到。如不方便去庙里，可在安静的地方朝西拜观世音菩萨化木煞或者化身边的阴气。'],
            ['wx' => '水', 'letter' => '建议您去庙里拜玄天上帝让婴灵去报到。如不方便去庙里，可在安静的地方朝北拜玄天上帝化火煞或者化身边的阴气。'],
        ];

        $row = collect($letters)->where('wx', $zi_positions[0]['wx'])->first();

        return $row['letter'];
    }

    public function unbornKe($position, $relation_positions)
    {
        $wx = $this->getWxByDz($position['dz']);
        $wx_ke_me = $this->getWhoKeMe($wx);
        foreach ($relation_positions as $relation_position) {
            if ($relation_position['is_dong'] || $relation_position['is_an_dong']) {
                if ($this->getWxByDz($relation_position['dz']) == $wx_ke_me) {
                    return true;
                }
            }
        }
        return false;
    }
}