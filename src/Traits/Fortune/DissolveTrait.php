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
}