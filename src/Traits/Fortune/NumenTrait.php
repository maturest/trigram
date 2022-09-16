<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait NumenTrait
{
    /**
     * 获取守护神
     * @param string $god
     * @return string
     */
    public function getNumen($god = '世')
    {
        return $this->getLetters($this->getWxByGod($god));
    }

    /**
     * 获取守护神条目
     * @param $wxs
     * @return string
     */
    public function getLetters($wxs)
    {
        $wxs = $this->getGrowMeWxs($wxs);
        $letters = [
            ['wx' => '火', 'letter' => '朝东拜神农大帝【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx' => '土', 'letter' => '朝南拜关圣帝君【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx' => '金', 'letter' => '朝西拜地藏王菩萨【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx' => '水', 'letter' => '朝西拜观世音菩萨【常去寺庙跟守护神做链接，或多观想守护神】'],
            ['wx' => '木', 'letter' => '朝北拜玄天上帝【常去寺庙跟守护神做链接，或多观想守护神】'],
        ];
        return collect($letters)->whereIn('wx', $wxs)->implode('letter', ';');
    }

    /**
     * 获取相应的来生五行
     * @param $wxs
     * @return mixed
     */
    public function getGrowMeWxs($wxs)
    {
        return collect($wxs)->map(function ($wx, $key) {
            return $this->getWhoGrowMe($wx);
        })->all();
    }

    /**
     * 获取用神十二地支对应的五行
     * @param $god
     * @return array
     */
    public function getWxByGod($god)
    {
        if ($god == '世') {
            return [$this->getWxByDz($this->getDzByShi())];
        }
        return $this->getWxBySixQin($god);
    }

    /**
     * 通过五行获取地支
     * @param $dz
     * @return mixed
     */
    public function getWxByDz($dz)
    {
        $dz_wx = collect($this->dzWx)->where('dz', $dz)->first();
        return $dz_wx['wx'];
    }

    /**
     * 获取世对应的十二地支
     * @return mixed
     */
    public function getDzByShi($set_position = true)
    {
        $shi_ying = explode(',', $this->resultDiZhi['shi_ying']);
        $shi_index = array_search('世', $shi_ying);

        $position = [
            'position' => $this->benGuaDetail[$shi_index]['column'] . $this->benGuaDetail[$shi_index]['row'],
            'is_dong' => $this->benGuaDetail[$shi_index]['is_dong'],
            'is_an_dong' => $this->benGuaDetail[$shi_index]['is_an_dong'],
            'dz' => $this->benGuaDetail[$shi_index]['dz'],
        ];

        //设置用神的位置
        if($set_position){
            $this->setGodPosition($position);
        }

        //设置世爻的位置
        if($set_position == false){
            $this->setShiPosition($position);
        }


        return $this->benGuaDetail[$shi_index]['dz'];
    }

    /**
     * 动态设置用神的位置
     * @param $position
     * @param bool $refresh
     */
    public function setGodPosition($position,$refresh = false)
    {
        if($refresh){
            $this->god_position = [$position];
            return;
        }

        $this->god_position = array_unique(array_merge($this->god_position,[$position]));
    }

    /**
     * @param $position
     */
    public function setShiPosition($position)
    {
        $this->shi_position = [$position];
    }


    /**
     * 通过六亲找寻对应的五行
     * @param $god
     * @return array
     */
    public function getWxBySixQin($god)
    {
        if (Str::contains($this->resultDiZhi['liu_qin'], $god)) {
            return $this->getWxByBenSixQin($god);
        }
        return $this->getWxByFuYao($god);
    }

    /**
     * 获取本爻中六亲的五行，防止有多个
     * @param $god
     * @return array
     */
    public function getWxByBenSixQin($god)
    {
        $res = [];
        //如果六亲中包含用神，为防止出现多个六亲，循环遍历,
        $tmp_arr = explode(',', $this->resultDiZhi['liu_qin']);
        foreach ($tmp_arr as $key => $value) {
            if ($value == $god) {


                $position = [
                    'position' => $this->benGuaDetail[$key]['column'] . $this->benGuaDetail[$key]['row'],
                    'is_dong' => $this->benGuaDetail[$key]['is_dong'],
                    'is_an_dong' => $this->benGuaDetail[$key]['is_an_dong'],
                    'dz' => $this->benGuaDetail[$key]['dz'],
                ];
                $this->setGodPosition($position);

                $res[] = $this->getWxByDz($this->benGuaDetail[$key]['dz']);

                //用神多现取旺相者，动爻大于静爻，本爻大于化爻
                if($this->benGuaDetail[$key]['is_dong'] || $this->benGuaDetail[$key]['is_an_dong']){
                    $res = [$this->getWxByDz($this->benGuaDetail[$key]['dz'])];
                    $this->setGodPosition($position,true);
                    break;
                }
            }
        }
        return array_unique($res);
    }

    /**
     * 根据是否有伏爻，有则根据伏爻定六亲
     * @param $god
     * @return array
     */
    public function getWxByFuYao($god)
    {
        $res = [];
        foreach ($this->draw['fu_yao'] as $fu_yao) {
            if (Str::startsWith($fu_yao['fu_yao'], '伏' . $god)) {
                $dz = mb_substr($fu_yao['fu_yao'],-1);
                $res[] = $this->getWxByDz($dz);

                $ben_yao =  collect($this->benGuaDetail)
                    ->where('column',$fu_yao['position'][0])
                    ->where('row',$fu_yao['position'][1])
                    ->first();

                $position = [
                    'position' => $fu_yao['position'],
                    'is_dong' => $ben_yao['is_dong'],
                    'is_an_dong' => $ben_yao['is_an_dong'],
                    'dz' =>$ben_yao['dz'],
                ];

                $this->setGodPosition($position);
            }
        }
        return array_unique($res);
    }

    /**
     * 获取相应的来克五行
     * @param $wxs
     * @return mixed
     */
    public function getKeMeWxs($wxs)
    {
        return collect($wxs)->map(function ($wx, $key) {
            return $this->getWhoKeMe($wx);
        })->all();
    }

}