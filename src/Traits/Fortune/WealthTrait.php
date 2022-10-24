<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait WealthTrait
{
    public function wealth($is_student = true)
    {
        $positions = $this->getGodPositionsWithSixQin('财');
        $position = $positions[0];

        $wealth = [];

        //如果是学生
        if ($is_student)
            $wealth[] = $this->getWealthByStudent($position);

        // 财爻的旺衰程度
        $wealth[] = $this->getWealthLevelByCai($position);

        $zi_positions = $this->getGodPositionsWithSixQin('子');
        $zi_position = $zi_positions[0];
        //子爻的旺衰程度
        $wealth[] = $this->getWealthLevelByZi($zi_position, $zi_positions);

        //子爻的五行
        $wealth[] = $this->getFriends($zi_position);

        //子爻方位
        $wealth[] = $this->getHelperPositionsByZi($zi_positions);

        //财爻方位
        $wealth[] = $this->getHelperDate($positions, $zi_positions);

        return $wealth;
    }

    protected function getWealthByStudent($position)
    {
        if ($this->getIsDongYaoByPosition($position)) {
            //克，冲，合，入
            if ($this->hasOneKeCongHeRu($position)) {
                return $this->getWealthBySinQin($position);
            }

            return '会有不错的零花钱积累，同时可以培养好的储蓄习惯，为未来金钱上的应用与规划做预演准备。生活中亦会有较多的兴趣爱好与追求，选择自己真正的爱好方向以更投入的态度去参与，会有助干成就感的塑造，培养专注、坚持等好习惯。';
        }

        return '会有不错的零花钱积累，同时可以培养好的储蓄习惯，为未来金钱上的应用与规划做预演准备。生活中亦会有较多的兴趣爱好与追求，选择自己真正的爱好方向以更投入的态度去参与，会有助干成就感的塑造，培养专注、坚持等好习惯。';
    }

    protected function getWealthBySinQin($position)
    {
        $row = collect($this->benGuaSixQin)->where('ben_gua', $this->resultDiZhi['ben_gua'])
            ->where('wx', $position['wx'])->first();

        $six_qin = $row['six_qin'];

        $letters = [
            ['six_qin' => '财', 'letter' => '会有出现花钱不合理的情况，同时多种兴趣爱好有可能出现冲突，合理地安排花销 合理分配兴趣爱好的时间会有助于提高金钱与精力的效率。'],
            ['six_qin' => '兄', 'letter' => '在与同伴的的互动中会有多花钱乱花钱的情况，同时自己也会有不节制的花钱现象，建议与小伙伴共同树立正确的金钱观并共勉之。'],
            ['six_qin' => '子', 'letter' => '有对金钱应用上的一些想法和方向，是可以被推崇和大胆尝试的，有助干塑造正确的理财观念。'],
            ['six_qin' => '官', 'letter' => '金钱或精力花费上会容易建立大家的正向认可感及正向影响力，可在这个层面做大胆尝试与练习，同时水能载舟亦能覆舟，在选择投入点建议卜卦确认，以免陷入不必要的事非之事中，妥当的的辨别是非练习有助于未来成长树立正确的金钱观。'],
            ['six_qin' => '父', 'letter' => '会有花钱倒腾于新的学习工具或某些学科的课外成长的尝试中，适时做好平衡，则有助于学业及生活成长的正向推动，过大的失衡带来的压力则不利于原有成长的环境，在做选择性尝试时亦可卜卦确认之。'],
        ];

        $row = collect($letters)->where('six_qin', $six_qin)->first();

        return $row['letter'];
    }

    /**
     * 获取财运程度
     * @param $position
     * @return string
     */
    public function getWealthLevelByCai($position)
    {
        return $this->wealthLevel($position) . $this->cashFlow($position);
    }

    /**
     * 某一爻的财运如何
     * @param $position
     * @param string $font
     * @return string
     */
    protected function wealthLevel($position, $font = '财')
    {
        if (!$this->getIsKeByPosition($position)
            && $this->isHuiJuByFont($font)
            && ($this->getIsDateGrowMe($position['wx']) || $this->isEqualDateWx($position['wx']))
            && $this->getIsDongYaoGrowMe($position['wx'])) {
            return '财运相当旺，';
        }

        if (!$this->getIsKeByPosition($position)
            && ($this->isHuiJuByFont($font)
                || ($this->getIsDateGrowMe($position['wx']) || $this->isEqualDateWx($position['wx']))
                || $this->getIsDongYaoGrowMe($position['wx']))) {
            return '财运旺，';
        }

        if (!$this->getIsKeByPosition($position)
            && ($this->getIsDongYaoGrowMe($position['wx'])
                || ($this->getIsDateGrowMe($position['wx']) || $this->isEqualDateWx($position['wx'])))) {
            return '财运较旺，';
        }

        if ($this->isWithDateKe($position['wx']) &&
            ($this->isHuiJuByFont($font)
                || ($this->getIsDateGrowMe($position['wx']) || $this->isEqualDateWx($position['wx']))
                || $this->getIsDongYaoGrowMe($position['wx']))) {
            return '财运有起伏，';
        }

        if ($this->isWithDateKe($position['wx']) &&
            (!($this->getIsDateGrowMe($position['wx']) || $this->isEqualDateWx($position['wx'])))) {
            return '财运需加强，';
        }

        return '';
    }

    /**
     * 现金流
     * @param $position
     * @return string
     */
    public function cashFlow($position)
    {
        //判断是否被克，冲，合，或者入墓
        if ($this->hasOneKeCongHeRu($position)) {
            $str = '需注意现金流的管控与资金的储备，以免出现不必要的财务问题，??投资需多谨慎，必要时建议可多方面卜卦确认。';
            $cashConditions = $this->cashConditions($position);
            return Str::replaceArray('?', $cashConditions, $str);
        }

        return '现金流充裕，可做更多渠道的财务规划与投资，建议规划与投资时可卜卦确认。';
    }

    /**
     * 现金流条件数组
     * @param $position
     * @return array
     */
    protected function cashConditions($position)
    {
        $conditions = [];
        //财爻空亡，入墓或者被合
        if ($this->getIsKongWangByPosition($position) || $this->getIsRuByPosition($position) || $this->getIsHeByPosition($position)) {
            $conditions[] = '财会有接不住的现象，';
        } else {
            $conditions[] = '';
        }

        if ($this->getIsKeByPosition($position) || $this->getIsCongByPosition($position)) {
            $str = '现金流震荡会有不稳定的情况，';

            //财爻被动爻克，财为动爻，并且被日月克
            $is_dong = ($position['is_dong'] ?? '') || ($position['is_an_dong'] ?? '');
            $wx = $position['wx'] ?? '';
            if ($this->isWithKe($wx, false) || ($is_dong && $this->isWithDateKe($wx))) {
                $str = $str . '要注意和' . $wx . '形脸的人接触，避免会有被劫财的现象。';
            }

            //财爻化官，官动爻，财为动并且日月为官
            if ($this->isNeedSpend($position)) {
                $str .= '容易会有是非破财的情况。';
            }
            $conditions[] = $str;
        } else {
            $conditions[] = '';
        }

        return $conditions;
    }

    /**
     * 是否破财
     * @param $position
     * @return bool
     */
    protected function isNeedSpend($position)
    {
        //财爻化官 财爻为动爻并且对应的化爻与本卦的六亲为官
        if (isset($position['is_dong']) && $position['is_dong']) {
            if ($this->getTranSixQinIsEqualOfferedSixQin($position, '官')) {
                return true;
            }

            //财爻为动爻或者日月为官
            if ($this->getSixQinByDz($this->getDayDz()) == '官' && $this->getSixQinByDz($this->getMonthDz()) == '官') {
                return true;
            }
        }

        //官爻是动爻
        $positions = $this->getPositionsWithSixQin('官');
        $is_dong = collect($positions)->first(function ($value, $key) {
            return $value['is_dong'] || $value['is_an_dong'];
        });

        return $is_dong;
    }

    protected function getWealthLevelByZi($position, $positions)
    {
        return $this->wealthLevel($position, '子')
            . $this->getChannels($position, $positions)
            . $this->getAttentions($position);
    }

    protected function getChannels($position, $positions)
    {
        $str = '';

        if ($this->hasOneKeCongHeRu($position)) {
            $str .= '注意来财渠道上会收到不稳定的影响。';
        } else {
            $str .= '有很不错的来财渠道，可做好计划并好好把握。';
        }

        if (count($positions) >= 2 || ($this->getSixQinByDz($this->getDayDz()) == '子' || $this->getSixQinByDz($this->getMonthDz()) == '子')) {
            $str .= '有多方来财的可能，可做更多渠道的财务规划与投资，建议规划与投资时可卜卦确认。';
        }

        return $str;
    }

    protected function getAttentions($position)
    {
        $str = '';

        if ($this->getIsDongYaoByPosition($position)) {
            $day_six_qin = $this->getSixQinByDz($this->getDayDz());
            $month_six_qin = $this->getSixQinByDz($this->getMonthDz());

            if (($day_six_qin == '财' || $month_six_qin == '财')
                && ($this->getIsHeByPosition($position, true) || $this->getIsRuByPosition($position, true))
            ) {
                $str .= '会有再对外投资的现象。';
            }

            if ($day_six_qin == '父' || $month_six_qin == '父') {
                $str .= '注意在事业上或投资上对财源造成的压力。';
            }

            if (($day_six_qin == '官' || $month_six_qin == '官')
                && $this->getIsHeByPosition($position, true)
            ) {
                $str .= '财源会有受到大环境或者政策上的影响。';
            }

            if (($day_six_qin == '兄' || $month_six_qin == '兄')
                && ($this->getIsHeByPosition($position, true) || $this->getIsRuByPosition($position, true))
            ) {
                $str .= '来财渠道会受到同行或者外部竞争者的截胡。';
            }

            if (($day_six_qin == '子' || $month_six_qin == '子')
                && $this->isWithDateKe($position['wx'])
            ) {
                $str .= '多个来财渠道会有冲突的情况。';
            }

        }

        return $str;
    }

    protected function getFriends($position)
    {
        $wx = $position['wx'] ?? '';
        $letters = [
            ['wx' => '木', 'letter' => '多?与有博爱、性情随和、感情丰富、心胸宽广的人链接有助财运的增长。'],
            ['wx' => '火', 'letter' => '多?与彬彬有礼、性情刚烈、热情爽快、待人耿直的人链接有助财运的增长。'],
            ['wx' => '土', 'letter' => '多?与忠厚老实、宽宏大量、踏实肯干、讲信守誉的人链接有助财运的增长。'],
            ['wx' => '金', 'letter' => '多?与不卑不亢、行动稳成、刚毅果决、重情重义的人链接有助财运的增长。'],
            ['wx' => '水', 'letter' => '多?与足智多谋、聪明好学、好动健谈、灵活多变的人链接有助财运的增长。'],
        ];

        $row = collect($letters)->where('wx', $wx)->first();
        $replace = $this->getIsStaticYaoByPosition($position) ? '主动' : '';
        return str_replace('?', $replace, $row['letter']);
    }

    protected function getHelperPositionsByZi($positions)
    {
        $directions = [
            ['dz' => '子', 'direction' => '正北',],
            ['dz' => '丑', 'direction' => '东北偏北',],
            ['dz' => '寅', 'direction' => '东北偏东',],
            ['dz' => '卯', 'direction' => '正东',],
            ['dz' => '辰', 'direction' => '东南偏东',],
            ['dz' => '巳', 'direction' => '东南偏南',],
            ['dz' => '午', 'direction' => '正南',],
            ['dz' => '未', 'direction' => '西南偏南',],
            ['dz' => '申', 'direction' => '西南偏西',],
            ['dz' => '酉', 'direction' => '正西',],
            ['dz' => '戌', 'direction' => '西北偏西',],
            ['dz' => '亥', 'direction' => '西北偏北',],
        ];
        $helper_directions = [];
        foreach ($positions as $position) {
            $row = collect($directions)->where('dz', $position['dz'])->first();
            $helper_directions[] = $row['direction'];
        }

        return "多往住家或办公室的" . implode('，', $helper_directions) . "方向走动有助于财运的增长。";
    }

    protected function getHelperDate($cai_positions, $zi_positions)
    {
        $cai_dzs = collect($cai_positions)->pluck('dz')->toArray();
        $zi_dzs = collect($zi_positions)->pluck('dz')->toArray();
        $dzs = array_unique(array_merge($cai_dzs, $zi_dzs));
        return "财运在" . implode('，', $dzs) . "月以及每月的" . implode('，', $dzs) . "日较旺。";
    }


}