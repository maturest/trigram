<?php


namespace Maturest\Trigram;

use Maturest\Trigram\Traits\GodNums\Gram;
use Maturest\Trigram\Traits\GodNums\GodNums;
use Maturest\Trigram\Traits\GodNums\Prosper;
use Maturest\Trigram\Traits\GodNums\Raw;
use Maturest\Trigram\Traits\GodNums\Wx;
use Maturest\Trigram\Traits\GodNums\YinYang;

class Plate extends BaseService
{
    use Gram,GodNums,Wx,YinYang,Raw,Prosper;

    public function getResultBySolar($date)
    {
        //1、获取阳历生日对应的日期详情
        $this->solar($date);

        //2、获取先天数和后天数
        $frontNums = $this->frontNums($date);
        $laterNums = $this->laterNums($frontNums);

        //3、十二神数排盘
        $relations = $this->relations($frontNums,$laterNums);

        return $relations;
    }

    /**
     * 获取十二神数的关系
     * @param $frontNums
     * @param $laterNums
     * @return array
     */
    protected function relations($frontNums,$laterNums)
    {
        // 生成新的先天数组
        $front_nums = $this->createNewArr($frontNums);
        // 生成新的后天数组
        $later_nums = $this->createNewArr($laterNums);

        // 获取 克关系 的数据
        $grams = $this->getGramRelation($frontNums,$front_nums,$laterNums,$later_nums);

        // 获取 阴阳 的数据
        $yin_yang = $this->getYinYangRelation($front_nums,$later_nums);

        //获取 生 关系
        $raws = $this->getRawRelation($frontNums,$front_nums,$laterNums,$later_nums);

        //获取 比旺 关系
        $prosper = $this->getProsperRelation($frontNums,$front_nums,$laterNums,$later_nums);

        //获取所对应的五行
        $wx = $this->getWxByNums($front_nums,$later_nums);


        return array_merge(compact('front_nums','later_nums'),$grams,$wx,$yin_yang,$raws,$prosper);
    }



    public function getResultByLunar($date, $isLeapMonth = false)
    {
        //1、获取阳历生日对应的日期详情
        $this->lunar($date,$isLeapMonth);

        //2、获取先天数和后天数
        $frontNums = $this->frontNums($date);
        $laterNums = $this->laterNums($frontNums);

        //3、十二神数排盘
        $relations = $this->relations($frontNums,$laterNums);

        return $relations;
    }
}