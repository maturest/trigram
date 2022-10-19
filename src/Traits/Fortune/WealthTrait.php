<?php


namespace Maturest\Trigram\Traits\Fortune;


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

        // 财爻的程度
        $wealth[] = $this->getWealthLevel($position);


        return $wealth;
    }

    public function getWealthByStudent($position)
    {
        if ($position['is_dong'] || $position['is_an_dong']) {
            //克，冲，合，入
            if ($this->getIsKeByPosition($position) || $this->getIsCongByPosition($position)
                || $this->getIsRuByPosition($position) || $this->getIsHeByPosition($position)) {
                return $this->getWealthBySinQin($position);
            }

            return '会有不错的零花钱积累，同时可以培养好的储蓄习惯，为未来金钱上的应用与规划做预演准备。生活中亦会有较多的兴趣爱好与追求，选择自己真正的爱好方向以更投入的态度去参与，会有助干成就感的塑造，培养专注、坚持等好习惯。';
        }

        return '会有不错的零花钱积累，同时可以培养好的储蓄习惯，为未来金钱上的应用与规划做预演准备。生活中亦会有较多的兴趣爱好与追求，选择自己真正的爱好方向以更投入的态度去参与，会有助干成就感的塑造，培养专注、坚持等好习惯。';
    }

    public function getWealthBySinQin($position)
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
    public function getWealthLevel($position)
    {
        if (!$this->getIsKeByPosition($position)
            && ($this->isHuiJuByFont() || $this->getIsDateGrowMe($position['wx']))
            && ($this->isEqualDateWx($position['wx']) || $this->getIsDongYaoGrowMe($position['wx']))) {
            return '财运相当旺';
        }

        if (!$this->getIsKeByPosition($position)
            && (($this->isHuiJuByFont() || $this->getIsDateGrowMe($position['wx']))
                || ($this->isEqualDateWx($position['wx']) || $this->getIsDongYaoGrowMe($position['wx'])))) {
            return '财运旺';
        }

        if (!$this->getIsKeByPosition($position)
            && (($this->getIsDateGrowMe($position['wx']))
                || ($this->isEqualDateWx($position['wx']) || $this->getIsDongYaoGrowMe($position['wx'])))) {
            return '财运较旺';
        }

        if ($this->isWithDateKe($position['wx']) && (($this->isHuiJuByFont() || $this->getIsDateGrowMe($position['wx']))
                || ($this->isEqualDateWx($position['wx']) || $this->getIsDongYaoGrowMe($position['wx'])))) {
            return '财运有起伏';
        }

        if ($this->isWithDateKe($position['wx']) && ((!$this->getIsDateGrowMe($position['wx']))
                && ($this->isEqualDateWx($position['wx'])))) {
            return '财运需加强';
        }

        return '';
    }


}