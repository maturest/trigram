<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait DissolveTrait
{
    public function dissolve($god)
    {
        //条件数组
        $conditions = $this->getConditions($god);

        return '';
    }

    public function baiWho($year)
    {
        $letters = [
            ['wx' => '火', 'is_cong' => false, 'bai' => '朝东拜神农大帝???保佑'."{$year}运势平安"],
            ['wx' => '土', 'is_cong' => false, 'bai' => '朝南拜关圣帝君???保佑'."{$year}运势平安"],
            ['wx' => '金', 'is_cong' => false, 'bai' => '朝西拜地藏王菩萨???保佑'."{$year}运势平安"],
            ['wx' => '金', 'is_cong' => true, 'bai' => '朝西拜观世音菩萨???保佑'."{$year}运势平安"],
            ['wx' => '水', 'is_cong' => false, 'bai' => '朝西拜观世音菩萨???保佑'."{$year}运势平安"],
            ['wx' => '水', 'is_cong' => true, 'bai' => '朝北拜玄天上帝???保佑'."{$year}运势平安"],
            ['wx' => '木', 'is_cong' => false, 'bai' => '朝北拜玄天上帝???保佑'."{$year}运势平安"],
        ];
    }

    public function getConditions($god)
    {
        $god_wx = $this->getWxByGod($god)[0];
        $res = [];
        //条件一
        $res[] = $this->getHuaSha($god_wx);
        //条件二
        $res[] = $this->getWholeFortune();
        //条件三
        $res[] = $this->getMagnatePower($god_wx);
        //条件四 年份
        $res[] = '神马年';

        return $res;
    }

    public function getWholeFortune()
    {
        //用神空亡，入墓，合
        $position = $this->god_position[0];

        if($this->getIsKongWangByPosition($position)
            || $this->getIsRuByPosition($position)
            || $this->getIsHeByPosition($position)){
            return '增强个人整体运势';
        }

        return '';
    }

    public function getMagnatePower($god_wx)
    {
        //生用神的爻的位置
        $positions = $this->getPositionsWhoGrowMe($god_wx);
        foreach($positions as $position){
            if($this->getIsKongWangByPosition($position)
                || $this->getIsRuByPosition($position)
                || $this->getIsHeByPosition($position)){
                return '加强贵人力量';
            }
        }
        return '';
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
        foreach($this->getDongYao() as $yao){
            if($wx_grow_me == $this->getWxByDz($yao['dz'])){
                $positions[] = ['position' => $yao['column'].$yao['row']];
            }
        }

        return $positions;
    }

    public function getHuaSha($god_wx)
    {
        //化煞1
        $hua_sha[] = $this->getHuaSha1($god_wx);
        //化煞2
        $hua_sha[] = $this->getHuaSha2($god_wx);

        return implode(',',array_filter(array_unique($hua_sha)));
    }

    public function getHuaSha1($god_wx)
    {
        $position = $this->god_position[0];
        //通过用神的五行来克方
        $is_with_ke_god = $this->getIsKeByPosition($position);
        //用神被动爻或者日月克
        if($is_with_ke_god){
            $wx_grow_me = $this->getWhoGrowMe($god_wx);
            //用神爻被动爻生 && 生世爻的爻不带合或入
            if(in_array($wx_grow_me,$this->getDongYaoWx()) && $this->growShiIsWithHeOrRu() ){
                return '';
            }else{
                return $this->getHuaShaByWx($god_wx);
            }
        }else{
            return $this->getHuaShaByWx($god_wx);
        }
    }

    /**
     * 动爻的冲克包含动爻与日月的关系，静爻的冲克仅考虑动爻的关系
     * @param $god_wx
     * @return string
     */
    public function getHuaSha2($god_wx)
    {
        //用神有动爻冲或有动爻克
        $god_position = $this->god_position[0];

        //如果是暗动
        if($god_position['is_an_dong']){
            return $this->getHuaShaByWx($god_wx);
        }

        //如果是明动，看是否被其他动爻冲或者克
        if($god_position['is_dong']){
            //是不是被冲
            if($this->isWithCong($god_position['position'])){
                return $this->getHuaShaByWx($god_wx);
            }
            //是不是被克
            if($this->isWithKe($god_wx)){
                return $this->getHuaShaByWx($god_wx);
            };
        }

        //如果是静爻，看是否有动爻冲或者动爻克。
        foreach ($this->getDongYaoDz() as $dz){
            if($this->isCongRelation($dz,$god_position['dz'])){
                return $this->getHuaShaByWx($god_wx);
            }
        }

        if($this->isWithKe($god_wx,false)){
            return $this->getHuaShaByWx($god_wx);
        }

        return '';
    }

    public function getHuaShaByWx($god_wx)
    {
        $letters = [
            ['wx' => '木','hs'=>'化金煞',],
            ['wx' => '火','hs'=>'化水煞',],
            ['wx' => '土','ke' => true,'cong' => false,'hs'=>'化木煞',],
            ['wx' => '土','ke' => false,'cong' => true,'hs'=>'化土煞',],
            ['wx' => '土','ke' => true,'cong' => true,'hs'=>'化土煞、木煞',],
            ['wx' => '金','ke' => true,'cong' => false,'hs'=>'化火煞',],
            ['wx' => '金','ke' => false,'cong' => true,'hs'=>'化木煞',],
            ['wx' => '金','ke' => true,'cong' => true,'hs'=>'化木煞、火煞',],
            ['wx' => '水','ke' => true,'cong' => false,'hs'=>'化土煞',],
            ['wx' => '水','ke' => false,'cong' => true,'hs'=>'化火煞',],
            ['wx' => '水','ke' => true,'cong' => true,'hs'=>'化火煞、土煞',],

        ];
        if(in_array($god_wx,['木','火'])){
            $row = collect($letters)->where('wx',$god_wx)->first();
            return $row['hs'];
        }

        // 动态设置世的位置
        $this->getDzByShi(false);
        $position = $this->shi_position[0];
        // 判断世爻是否被冲
        $is_cong = $this->getIsCongByPosition($position);
        // 判断世爻是否被克
        $is_ke = $this->getIsKeByPosition($position);

        $row = collect($letters)->where('wx',$god_wx)->where('ke',$is_ke)->where('cong',$is_cong)->first();
        return $row['hs'];
    }

    /**
     * 判断某一位置是否携带合
     * @param $position
     * @return bool
     */
    public function isWithHe($position)
    {
        $with_he = false;
        foreach($this->draw['six_he'] as $six_he){
            if(Str::contains($six_he,$position)){
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
        foreach($this->draw['ru_mu'] as $ru_mu){
            if(Str::contains($ru_mu,$position)){
                $with_ru = true;
                break;
            }
        }
        return $with_ru;
    }

    /**
     * 判断某一位置是不是冲
     * @param $position
     * @return bool
     */
    public function isWithCong($position)
    {
        $with_cong = false;
        foreach($this->draw['six_chong'] as $six_chong){
            if(Str::contains($six_chong,$position)){
                $with_cong = true;
                break;
            }
        }
        return $with_cong;
    }


    /**
     * 某一位置的五行是不是被克,默认携带日令月令
     * @param $wx
     * @param bool $date
     * @return bool
     */
    public function isWithKe($wx,$date = true)
    {
        //动爻的五行
        $wxs = $this->getDongYaoWx();

        if( $date ){
            //日令月令的五行
            $date_wxs = $this->getDateWx();

            //通过十二地支去找五行
            $wxs = array_merge($wxs,$date_wxs);
        }

        $wx_ke_me = $this->getWhoKeMe($wx);

        return in_array($wx_ke_me,$wxs);
    }

    public function getDongYao()
    {
        return collect($this->benGuaDetail)->filter(function ($item, $key) {
            return $item['is_dong'] || $item['is_an_dong'];
        });
    }

    public function getDongYaoDz()
    {
        $dong_yao = $this->getDongYao();
        return $dong_yao->pluck('dz')->toArray();
    }

    public function getDateDz()
    {
        return [$this->diZhiDay,$this->diZhiMonth];
    }

    public function getDongYaoWx()
    {
        $dong_dzs = $this->getDongYaoDz();
        $dong_wxs = [];
        foreach($dong_dzs as $dong_dz){
            $dong_wxs[] = $this->getWxByDz($dong_dz);
        }
        return $dong_wxs;
    }

    public function getDateWx()
    {
        $date_dzs = $this->getDateDz();
        $date_wxs = [];
        foreach($date_dzs as $date_dz){
            $date_wxs[] = $this->getWxByDz($date_dz);
        }
        return $date_wxs;
    }

    /**
     * 生世爻的爻带不带合或入
     * @return bool
     */
    public function growShiIsWithHeOrRu()
    {
        $is_with_he_or_ru = false;

        $shi_wx = $this->getWxByGod('世')[0];
        $wx_grow_shi = $this->getWhoGrowMe($shi_wx);
        foreach($this->getDongYao() as $yao){
            if($wx_grow_shi == $this->getWxByDz($yao['dz'])){
                $position = $yao['column'].$yao['row'];
                //带不带合
                if($this->isWithHe($position)){
                    $is_with_he_or_ru = true;
                    break;
                }
                //带不带入
                if($this->isWithRu($position)){
                    $is_with_he_or_ru = true;
                    break;
                }
            }
        }
        return $is_with_he_or_ru;
    }


    /**
     * 判断某一点是不是带冲
     * @param $position
     * @return bool
     */
    public function getIsCongByPosition($position)
    {
        //如果是暗动
        if($position['is_an_dong']){
            return true;
        }

        //如果是明动，看是否被其他动爻冲或者克
        if($position['is_dong']){
            //是不是被冲
            return $this->isWithCong($position['position']);
        }

        //如果是静爻，看是否有动爻冲或者动爻克。
        foreach ($this->getDongYaoDz() as $dz){
            if($this->isCongRelation($dz,$position['dz'])){
                return true;
            }
        }

        return false;
    }

    /**
     * @param $position
     * @param string $wx 对应位置的五行
     * @return bool|string
     */
    public function getIsKeByPosition($position)
    {
        $wx = $this->getWxByDz($position['dz']);

        //如果是明动或者暗动
        if($position['is_dong'] || $position['is_an_dong']){
            return $this->isWithKe($wx);
        }

        //如果是静爻
        return $this->isWithKe($wx,false);
    }

    /**
     * 判断某个位置是否空亡
     * @param $position
     * @return bool
     */
    public function getIsKongWangByPosition($position)
    {
        $coords = $this->draw['kong_wang']['coords'];

        foreach($coords as $coord){
            return $coord['x'].$coord['y'] == $position['position'];
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
        foreach($this->draw['ru_mu'] as $ru_mu){
            if(Str::contains($ru_mu,$position['position'])){
                return true;
            }
        }
        return false;
    }

    /**
     * 判断某一位置是否合
     * @param $position
     * @return bool
     */
    public function getIsHeByPosition($position)
    {
        foreach($this->draw['six_he'] as $six_he){
            if(Str::contains($six_he,$position['position'])){
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
                ];
            }
        }

        //如果是伏爻
        foreach ($this->draw['fu_yao'] as $fu_yao) {
            if (Str::startsWith($fu_yao['fu_yao'], '伏' . $six_qin)) {
                $ben_yao =  collect($this->benGuaDetail)
                    ->where('column',$fu_yao['position'][0])
                    ->where('row',$fu_yao['position'][1])
                    ->first();

                $positions[] = [
                    'position' => $fu_yao['position'],
                    'is_dong' => $ben_yao['is_dong'],
                    'is_an_dong' => $ben_yao['is_an_dong'],
                    'dz' =>$ben_yao['dz'],
                ];
            }
        }

        return array_unique($positions);
    }

    /**
     * 月运势卦
     * @param $god
     * @return mixed
     */
    public function fortuneTrigram($god)
    {
        $god_wx = $this->getWxByGod($god)[0];

        $letters = [
            ['wx'=>'木','letter'=>'建议您在申月、酉月卜当月运势卦'],
            ['wx'=>'火','letter'=>'建议您在亥月、子月卜当月运势卦'],
            ['wx'=>'土','letter'=>'建议您在寅月、卯月卜当月运势卦'],
            ['wx'=>'金','letter'=>'建议您在巳月、午月卜当月运势卦'],
            ['wx'=>'水','letter'=>'建议您在丑月、辰月、未月、戌月卜当月运势卦'],
        ];

        $row = collect($letters)->where('wx',$god_wx)->first();
        return $row['letter'];
    }

    /**
     * 旅行卦
     * 父爻的五行是动爻，并且被克，被冲或入墓
     */
    public function tripTrigram($six_qin = '父')
    {
        $positions = $this->getPositionsWithSixQin($six_qin);
        foreach($positions as $position){
            if($position['is_dong'] || $position['is_an_dong']){
                if($this->getIsKeByPosition($position) || $this->getIsKeByPosition($position) || $this->getIsRuByPosition($position)){
                    return '建议您出远门卜出行卦，注意交通工具安全，避免疲劳驾驶。';
                }
            }
        }

        return '';
    }

    /**
     * 获取世应的位置
     * @param string $font
     * @return array
     */
    public function getShiOrYingPosition($font='世')
    {
        $shi_ying  = explode(',', $this->resultDiZhi['shi_ying']);
        $index = array_search($font, $shi_ying);
        $position = [
            'position' => $this->benGuaDetail[$index]['column'] . $this->benGuaDetail[$index]['row'],
            'is_dong' => $this->benGuaDetail[$index]['is_dong'],
            'is_an_dong' => $this->benGuaDetail[$index]['is_an_dong'],
            'dz' => $this->benGuaDetail[$index]['dz'],
        ];
        return $position;
    }

    /**
     * 获取世或者应的六亲
     * @param string $font
     * @return false|int|string
     */
    public function getSixQinByShiOrYing($font='世')
    {
        $shi_ying = explode(',', $this->resultDiZhi['shi_ying']);
        $six_qin = explode(',',$this->resultDiZhi['liu_qin']);
        $arr = array_combine($six_qin,$shi_ying);
        return array_search($font,$arr);
    }

    /**
     * 净化磁场
     */
    public function cleanMagneticField()
    {
        $six_qin_ying = $this->getSixQinByShiOrYing('应');
        $six_qin_shi = $this->getSixQinByShiOrYing('世');

        if($six_qin_ying == '官' && in_array($six_qin_shi,['兄','子','财','官'])){
            return '建议您卜卦择日净化住家磁场';
        }

        if($six_qin_ying == '兄' && in_array($six_qin_shi,['兄','财','官','父'])){
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

        if( ! $is_pregnant ){
            foreach($guan_positions as $position){
                //如果官爻是动爻
                if($position['is_dong'] || $position['is_an_dong']){

                    //判断是否有合的关系
                    if($this->getIsHeByPosition($position)){
                        if($this->isNeedUnborn($position,$brother_positions,'six_he')
                            || $this->isNeedUnborn($position,$child_positions,'six_he')){
                            return $this->cleanYinQi();
                        }
                    }

                    //判断是否有冲的关系
                    if($this->getIsCongByPosition($position)){
                        if($this->isNeedUnborn($position,$brother_positions,'six_chong')
                            || $this->isNeedUnborn($position,$child_positions,'six_chong')){
                            return $this->cleanYinQi();
                        }
                    }

                    //判断是否有入的关系
                    if($this->getIsRuByPosition($position)){
                        if($this->isNeedUnborn($position,$brother_positions,'ru_mu')
                            || $this->isNeedUnborn($position,$child_positions,'ru_mu')){
                            return $this->cleanYinQi();
                        }
                    }

                    //判断是否有克的关系
                    if($this->unbornKe($position,$brother_positions) || $this->unbornKe($position,$child_positions) ){
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
    public function isNeedUnborn($position,$relation_positions,$relation='six_he')
    {
        foreach($this->draw[$relation] as $item){
            $tmp_arr = explode('-',$item);
            if(in_array($position['position'],$tmp_arr)){
                $tmp_arr = array_diff($tmp_arr,[$position['position']]);
                foreach($relation_positions as $relation_position){
                    if(in_array($relation_position['position'],$tmp_arr) && ($relation_position['is_dong'] || $relation_position['is_an_dong'])){
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * 官爻的位置是否与兄或者子动爻相克
     * @param $position
     * @param $relation_positions
     */
    public function unbornKe($position,$relation_positions)
    {
        $wx = $this->getWxByDz($position['dz']);
        $wx_ke_me = $this->getWhoKeMe($wx);
        foreach ($relation_positions as $relation_position){
            //如果是动爻
            if($relation_position['is_dong'] || $relation_position['is_an_dong']){
                if($this->getWxByDz($relation_position['dz']) == $wx_ke_me){
                    return true;
                }
            }
        }
        return false;
    }

    public function cleanYinQi()
    {
        $wxs = $this->getWxBySixQin('子');

        $letters = [
            ['wx'=>'木','letter'=>'建议您去庙里拜神农大帝让婴灵去报到。如不方便去庙里，可在安静的地方朝东拜神农大帝化土煞或者化身边的阴气'],
            ['wx'=>'火','letter'=>'建议您去庙里拜关圣帝君让婴灵去报到。如不方便去庙里，可在安静的地方朝南拜关圣帝君化金煞或者化身边的阴气'],
            ['wx'=>'土','letter'=>'建议您去庙里拜地藏王菩萨让婴灵去报到。如不方便去庙里，可在安静的地方朝西拜地藏王菩萨化水煞或者化身边的阴气'],
            ['wx'=>'金','letter'=>'建议您去庙里拜观世音菩萨让婴灵去报到。如不方便去庙里，可在安静的地方朝西拜观世音菩萨化木煞或者化身边的阴气'],
            ['wx'=>'水','letter'=>'建议您去庙里拜玄天上帝让婴灵去报到。如不方便去庙里，可在安静的地方朝北拜玄天上帝化火煞或者化身边的阴气'],
        ];

        $row = collect($letters)->where('wx',$wxs[0])->first();

        return $row['letter'];
    }
}