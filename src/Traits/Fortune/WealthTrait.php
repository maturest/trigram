<?php


namespace Maturest\Trigram\Traits\Fortune;


trait WealthTrait
{
    public function wealth($is_student = true)
    {
        if($is_student)
            return $this->getWealthByStudent();

        return '';
    }

    public function getWealthByStudent()
    {
        $positions = $this->getGodPositionsWithSixQin('财');
        $position = $positions[0];

        if($position['is_dong'] || $position['is_an_dong']){
            //克，冲，合，入
            if($this->getIsKeByPosition($position) || $this->getIsCongByPosition($position)
                || $this->getIsRuByPosition($position) || $this->getIsHeByPosition($position)){
                return $this->getWealthBySinQin($position);
            }

            return '';
        }

        return '';
    }

    public function getWealthBySinQin($position)
    {
        $row = collect($this->benGuaSixQin)->where('ben_gua',$this->resultDiZhi['ben_gua'])
            ->where('wx',$position['wx'])->first();

        $six_qin = $row['six'];

    }
}