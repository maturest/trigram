<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

/**
 * 时来运转
 * Trait TransformTrait
 * @package Maturest\Trigram\Traits\Fortune
 */
trait TransformTrait
{
    protected $directions = [
        ['dz' => '子', 'direction' => '正北'],
        ['dz' => '丑', 'direction' => '东北偏北'],
        ['dz' => '寅', 'direction' => '东北偏东'],
        ['dz' => '卯', 'direction' => '正东'],
        ['dz' => '辰', 'direction' => '东南偏东'],
        ['dz' => '巳', 'direction' => '东南偏南'],
        ['dz' => '午', 'direction' => '正南'],
        ['dz' => '未', 'direction' => '西南偏南'],
        ['dz' => '申', 'direction' => '西南偏西'],
        ['dz' => '酉', 'direction' => '正西'],
        ['dz' => '戌', 'direction' => '西北偏西'],
        ['dz' => '亥', 'direction' => '西北偏北'],
    ];

    protected $wxColor = [
        ['wx'=>'金','color'=>'白色'],
        ['wx'=>'木','color'=>'绿色或者紫色'],
        ['wx'=>'水','color'=>'黑色或者蓝色'],
        ['wx'=>'火','color'=>'红色'],
        ['wx'=>'土','color'=>'黄色'],
    ];

    protected $wxNumber = [
        ['wx'=>'金','number'=>'9'],
        ['wx'=>'木','number'=>'3'],
        ['wx'=>'水','number'=>'1'],
        ['wx'=>'火','number'=>'7'],
        ['wx'=>'土','number'=>'5'],
    ];


    public function transform($god)
    {
        $res = [];

        //子爻
        $res[] = $this->transformWithZi($god);

        //财爻
        $res[] = $this->transformWithCai($god);

        //父爻
        $res[] = $this->transformWithFu($god);

        //官或兄
        $res[] = $this->transformWithGod($god);

        return array_filter($res);
    }

    protected function transformWithZi($god)
    {
        $keyword = '子';
        $converged = $this->isHuiJuByFont($keyword);
        $position = $this->getPrimaryGodPositions($keyword);

        if($converged){
            // 如果用神爻被破
            if( $this->getIsCongByPosition($position) ){
                return $this->generalZi($god,$position);
            }

            return '';
        }

        if( $this->getIsDongYaoByPosition($position) && ( $this->hasOneKeCongHeRu($position) || $this->getIsKongWangByPosition($position) ) ){
            return $this->generalZi($god,$position);
        }


        if( ! ($this->getIsStaticTrigram($position) && ( $this->dateGrowEqual($position['wx']) || $this->onlyDongYaoGrowMe($position) ) ) ){
            return $this->generalZi($god,$position);
        };


        if( $god != $keyword ){
            if( ! ( $this->getIsVoltTrigram($position) && ( $this->dateGrowEqual($position['wx']) || $this->onlyBenYaoGrowMe($position) ) ) ){
                return $this->generalZi($god,$position);
            }
        }

        return '';
    }

    /**
     * It return transform of cai
     *
     * @param [type] $god
     * @return string
     */
    protected function transformWithCai($god)
    {
        $keyword = '财';

        $position = $this->getPrimaryGodPositions($keyword);

        $converged = $this->isHuiJuByFont($keyword);

        if($converged){
            // 如果用神爻被破
            if( $this->getIsCongByPosition($position) ){
                return $this->generalCai($god,$position);
            }

            return '';
        }

        if( $this->getIsDongYaoByPosition($position) && ( $this->hasOneKeCongHeRu($position) || $this->getIsKongWangByPosition($position) ) ){
            return $this->generalCai($god,$position);
        }


        if( ! ($this->getIsStaticTrigram($position) && ( $this->dateGrowEqual($position['wx']) || $this->onlyDongYaoGrowMe($position) ) ) ){
            return $this->generalCai($god,$position);
        };

        if( $god != $keyword ){
            if( ! ( $this->getIsVoltTrigram($position) && ( $this->dateGrowEqual($position['wx']) || $this->onlyBenYaoGrowMe($position) ) ) ){
                return $this->generalCai($god,$position);
            }
        }


        return '';
    }

    protected function transformWithFu($god)
    {
        $keyword = '父';

        $position = $this->getPrimaryGodPositions($keyword);

        $converged = $this->isHuiJuByFont($keyword);

        if($converged){
            // 如果用神爻被破
            if( $this->getIsCongByPosition($position) ){
                return $this->generalFu($god,$position);
            }

            return '';
        }

        if( $this->getIsDongYaoByPosition($position) && ( $this->hasOneKeCongHeRu($position) || $this->getIsKongWangByPosition($position) ) ){
            return $this->generalFu($god,$position);
        }


        if( ! ($this->getIsStaticTrigram($position) && ( $this->dateGrowEqual($position['wx']) || $this->onlyDongYaoGrowMe($position) ) ) ){
            return $this->generalFu($god,$position);
        };

        if( $god != $keyword ){
            if( ! ( $this->getIsVoltTrigram($position) && ( $this->dateGrowEqual($position['wx']) || $this->onlyBenYaoGrowMe($position) ) ) ){
                return $this->generalFu($god,$position);
            }
        }

        return '';
    }

    protected function transformWithGod($god)
    {
        if(in_array($god,['兄','官'])){

            $position = $this->god_positions[0];

            $converged = $this->isHuiJuByFont($god);

            if($converged){
                // 如果用神爻被破
                if( $this->getIsCongByPosition($position) ){
                    return $this->generalShi();
                }

                return '';
            }

            if( $this->getIsDongYaoByPosition($position) && ( $this->hasOneKeCongHeRu($position) || $this->getIsKongWangByPosition($position) ) ){
                return $this->generalShi();
            }


            if( ! ($this->getIsStaticTrigram($position) && ( $this->dateGrowEqual($position['wx']) || $this->onlyDongYaoGrowMe($position) ) ) ){
                return $this->generalShi();
            };

            return '';

        }

        return '';
    }


    /**
     * It returns the direction of the dz condition
     *
     * @param dz 十二地支
     *
     * @return sting
     */
    protected function getDirectionByDz($dz)
    {
        $row = collect($this->directions)->where('dz',$dz)->first();
        return $row['direction'];
    }

    /**
     * It returns the color of the wx condition.
     *
     * @param wx 五行
     *
     * @return strung
     */
    protected function getColorByWx($wx)
    {
        $row = collect($this->wxColor)->where('wx',$wx)->first();
        return $row['color'];
    }

    /**
     * > It returns a number associated with the wx.
     *
     * @param wx 五行
     *
     * @return string
     */
    protected function getNumberByWx($wx)
    {
        $row = collect($this->wxNumber)->where('wx',$wx)->first();
        return $row['number'];
    }

    /**
     * It returns transform of cai trigram
     *
     * @param string $god
     * @param array $position
     * @return string
     */
    public function generalCai($god,$position)
    {
        $str = "建议您在?方用?托盘放?颗?珠子加强财运?。";

        $replaces  = [];

        $replaces[] = $this->getDirectionByDz($position['dz']);

        //子爻
        $another_position = $this->getPrimaryGodPositions('子');

        $replaces[] = $this->getColorByWx($another_position['wx']);

        $replaces[] = $this->getNumberByWx($position['wx']);
        $replaces[] = $this->getColorByWx($position['wx']);

        $replaces[] = $god == '财' ? '和个人整体运势' : ( $god == '官' ? '和贵人运' : '');

        return Str::replaceArray('?', $replaces, $str);
    }

    protected function generalZi($god,$position)
    {
        $str = "建议您在?方用?托盘放?颗?珠子加强财源?。";

        $replaces  = [];

        $replaces[] = $this->getDirectionByDz($position['dz']);

        //兄爻
        $another_position = $this->getPrimaryGodPositions('兄');

        $replaces[] = $this->getColorByWx($position['wx']);

        $replaces[] = $this->getNumberByWx($another_position['wx']);
        $replaces[] = $this->getColorByWx($another_position['wx']);

        $replaces[] = $god == '子' ? '和个人整体运势' : ( $god == '财' ? '和贵人运' : '');

        return Str::replaceArray('?', $replaces, $str);
    }

    public function generalFu($god,$position)
    {
        $str = "建议您在?方用?托盘放?颗?珠子加强事业运?。";

        $replaces  = [];

        $replaces[] = $this->getDirectionByDz($position['dz']);

        //官爻
        $another_position = $this->getPrimaryGodPositions('官');

        $replaces[] = $this->getColorByWx($another_position['wx']);

        $replaces[] = $this->getNumberByWx($another_position['wx']);
        $replaces[] = $this->getColorByWx($another_position['wx']);

        $replaces[] = $god == '父' ? '和个人整体运势' : ( $god == '兄' ? '和贵人运' : '');

        return Str::replaceArray('?', $replaces, $str);
    }

    public function generalShi()
    {
        $str = "建议您在?方用?托盘放?颗?珠子加强个人整体运势。";

        $positions = $this->getGodPositions('世');
        $position = $positions[0];

        $replaces  = [];

        $replaces[] = $this->getDirectionByDz($position['dz']);

        $replaces[] = $this->getColorByWx($position['wx']);

        $grow_shi_wx = $this->getWhoGrowMe($position['wx']);

        $replaces[] = $this->getNumberByWx($grow_shi_wx);
        $replaces[] = $this->getColorByWx($grow_shi_wx);

        return Str::replaceArray('?', $replaces, $str);
    }
}