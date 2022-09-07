<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait NumenTrait
{
    /**
     * 获取守护神
     * @param string $god
     * @return array|mixed|string
     */
    public function numen($god = '世')
    {
        if($god == '世'){
            return $this->getNumenBySelf();
        }

        //如果是代人卜卦，则从六亲中寻找
        return $this->getNumenBySixQin($god);
    }

    public function getNumenBySixQin($god)
    {
        //如果本卦六亲中包含对应的用神
        if(Str::contains($this->resultDiZhi['liu_qin'],$god)){
            return $this->getLettersBySixQin($god);
        }

        //如果六亲中不包含用神，根据是否有伏爻，有则根据伏爻定六亲
        if($this->draw['fu_yao']){
            return $this->getLettersByFuYao();
        }

        return '';
    }

    public function getLettersByFuYao()
    {
        $res = [];
        foreach ($this->draw['fu_yao'] as $fu_yao){
            $tmp_arr = str_split($fu_yao['position']);
            $row = collect($this->benGuaDetail)->where('column',$tmp_arr[0])->where('row',$tmp_arr[1])->first();
            $res[] = $this->getNumenByDz($row['dz']);
        }
        return array_unique($res);
    }

    public function getLettersBySixQin($god)
    {
        $res = [];
        //如果六亲中包含用神，为防止出现多个六亲，循环遍历
        $tmp_arr = explode(',',$this->resultDiZhi['liu_qin']);
        foreach($tmp_arr as $key => $value){
            if($value == $god){
                $res[] =  $this->genNumenByIndex($key);
            }
        }
        return array_unique($res);
    }

    /**
     * 如果是本人卜卦,则返回世爻十二地支对应五行的来生的五行，然后取结果集
     * @return mixed
     */
    public function getNumenBySelf()
    {
        $shi_ying = explode(',',$this->resultDiZhi['shi_ying']);
        $shi_index = array_search('世',$shi_ying);
        return $this->genNumenByIndex($shi_index);
    }

    public function genNumenByIndex($index)
    {
        return $this->getNumenByDz($this->benGuaDetail[$index]['dz']);
    }

    public function getNumenByDz($dz)
    {
        $dz_wx = collect($this->dzWx)->where('dz', $dz)->first();
        return $this->letters($this->getWhoGrowMe($dz_wx['wx']));
    }

    public function letters($wx)
    {
        $letters = [
            ['wx'=>'火','letters'=>'朝东拜神农大帝【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx'=>'土','letters'=>'朝南拜关圣帝君【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx'=>'金','letters'=>'朝西拜地藏王菩萨【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx'=>'水','letters'=>'朝西拜观世音菩萨【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx'=>'木','letters'=>'朝北拜玄天上帝【常去寺庙跟守护神做链接，或多观想守护神】'],
        ];

        $row = collect($letters)->where('wx',$wx)->first();
        return $row['letters'];
    }
}