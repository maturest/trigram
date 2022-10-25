<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait CauseTrait
{
    /**
     * 事业运
     * @param $is_student
     * @return array
     */
    public function cause($is_student = false)
    {
        $letters = [];
        //父爻的位置
        $positions = $this->getGodPositionsWithSixQin('父');
        $position = $positions[0];

        //学生展示
        if ($is_student) {
            $letters[] = $this->getStudentCause($position);
        }

        //父爻的旺衰程度
        $letters[] = $this->getCaseLevel($position);

        $guan_positions = $this->getGodPositionsWithSixQin('官');
        $guan_position = $guan_positions[0];
        //官爻的事业贵人助力
        $letters[] = $this->getHelpers($guan_position, $position);

        //对事业有帮助的人
        $letters[] = $this->getHelperMen($guan_position);

        //对事业运有帮助的方向
        $letters[] = $this->getHelperDirections();

        //对事业运有用的地方
        $letters[] = $this->getHelperByDate();

        return $letters;
    }

    /**
     * 获取是学生的情况
     * @param $position
     * @return string
     */
    protected function getStudentCause($position)
    {
        if ($this->getIsKeByPosition($position)) {
            $tmp_arr = [];
            $tmp_arr[] = '今年在学业上会有不稳定的现象，成绩上会有起伏。';
            /* 反查克冲入合的关系 */
            $cai_letter = '要注意课外兴趣爱好活动、一些诱惑性娱乐等给学业上带来的负面影响，导致学习成绩上的下滑现象，建议合理分配时间，做到劳逸结合。';
            $cai_letters = $this->getStudyInfo($position, '财', $cai_letter);

            $zi_letter = '会有较多想法上的问题，避免大脑里的声音在学习上带来过多的分散以致不能集中注意力，可把成长中或学习上的困惑以平和的方式与长者交流互动、答疑解惑，让自己回归平静状态后轻装上阵，便可在学业上更为轻松前行。';
            $zi_letters = $this->getStudyInfo($position, '子', $zi_letter);

            $xiong_letter = '容易受到同学或朋友伙伴的影响而分散学习上的注意力，与同学伙伴相互之间应有更好的正向鼓励，共同学习、共同成长、共同体验，会为青春成长的路上留下美好的回忆。';
            $xiong_letters = $this->getStudyInfo($position, '兄', $xiong_letter);

            $fu_letter = '学习上注意会有偏科或难兼具的现象，不用太过介怀于追求每个科目的最佳状态，回归平常心，懂得先扬长，再修短板，借用长者在学习上的经验建议，脚踏实地、稳步完善，会在整体学习上给自己更大的正向驱动力。';
            $fu_letters = $this->getStudyInfo($position, '父', $fu_letter);

            $res = array_unique(array_merge($cai_letters, $zi_letters, $xiong_letters, $fu_letters));
            return implode('', $res);
        } else {
            if ($this->getIsDongAndTransYaoGrowMe($position['wx']) || $this->getIsDateGrowMe($position['wx'])) {
                return '今年在学业上会容易出不错的成绩，有外部良好的学习环境，自身有为学业沉浸其中的状态。学习上可乘胜追击上升档次，同时也要注意戒骄戒躁，稳步前进。';
            } else {
                return '今年在学业上没有很大的起伏，较为平稳的成绩，自身状态仍有可积极进取的空间，多与老师、家长链接沟通，主动出击有助于成绩上的提高。';
            }
        }
    }

    /**
     * 冲，克，入，合
     * @param $position
     */
    protected function getStudyInfo($position, $font, $letter)
    {
        $res = [];
        // 1、获取财的位置
        $six_qin_positions = $this->getPositionsWithSixQin($font, true);
        foreach ($six_qin_positions as $six_qin_position) {
            // 冲
            if ($this->isCongRelation($position['dz'], $six_qin_position['dz'])) {
                $res[] = $letter;
            };

            // 克
            if ($six_qin_position['wx'] == $this->getWhoKeMe($position['wx'])) {
                $res[] = $letter;
            }

            // 合
            if ($this->isHeRelation($position['dz'], $six_qin_position['dz'])) {
                $res[] = $letter;
            }

            // 入
            if ($this->isRuRelation($position, $six_qin_position)) {
                $res[] = $letter;
            }
        }

        return array_unique($res);
    }

    protected function getCaseLevel($position)
    {
        return $this->causeLevel($position) . $this->causeFlow($position);
    }

    /**
     * 事业运程度
     * @param $position
     * @return string
     */
    protected function causeLevel($position)
    {
        $hasNoKe = !$this->getIsKeByPosition($position);
        $isHuiJu = $this->isHuiJuByFont('父');
        $dateGrowAndEqual = $this->dateGrowEqual($position['wx']);
        $isYaoGrow = $this->getIsDongAndTransYaoGrowMe($position['wx']);

        if ($hasNoKe && (($isHuiJu && $dateGrowAndEqual) || ($isHuiJu && $isYaoGrow) || ($dateGrowAndEqual && $isYaoGrow))) {
            return '事业运相当旺，';
        }

        if ($hasNoKe && $isHuiJu && ($dateGrowAndEqual || $isYaoGrow)) {
            return '事业运旺，';
        }

        if ($hasNoKe && ($isYaoGrow || $dateGrowAndEqual)) {
            return '事业运较旺，';
        }

        if (!$hasNoKe && ($isHuiJu || $dateGrowAndEqual || $isYaoGrow)) {
            return '事业运有起伏，';
        }

        if (!$hasNoKe && !$dateGrowAndEqual) {
            return '事业运需加强，';
        }

        return '';
    }

    protected function causeFlow($position)
    {
        if ($this->hasOneKeCongHeRu($position)) {
            $str = '事业或投资上有震荡起伏，有不稳定因素，???项目的选择上需多谨慎，必要时建议可多方面卜卦确认。';
            $causeConditions = $this->causeConditions($position);
            return Str::replaceArray('?', $causeConditions, $str);
        }

        return '事业亨通，可做好事业的规划或者投资的管理，是事业扬升的好时机，可好好把握。';
    }

    protected function causeConditions($position)
    {
        $conditions = [];

        //1、父动爻与日月的关系
        $str = '';
        //1.1、父动爻被日月父冲
        if ($this->getIsDongYaoByPosition($position)
            && $this->getIsCongByDate($position['dz'])
        ) {
            $str .= '容易因多个事业项目之间的冲突照成麻烦。';
        }

        //1.2、日月为官与父爻合或者入
        if ($this->judgeDateSixQin('官') && ($this->getIsHeByPosition($position, true) || $this->getIsRuByPosition($position, true))) {
            $str .= '事业会陷入不必要的是非甚至官非中。';
        }

        //1.3、日月被兄合入
        $xiong_positions = $this->getGodPositionsWithSixQin('兄');
        $xiong_position = $xiong_positions[0];
        if ($this->getIsHeByPosition($xiong_position, true) || $this->getIsRuByPosition($xiong_position, true)) {
            $str .= '事业项目会有被同行或竞争对手截胡的可能。';
        }

        $conditions[] = $str;

        //2、父空亡或入墓或合
        if ($this->getIsKongWangByPosition($position) || $this->getIsRuByPosition($position) || $this->getIsHeByPosition($position)) {
            $conditions[] = '会有停滞或越做越小的情况，';
        } else {
            $conditions[] = '';
        }

        //3、父爻被冲或克
        if ($this->getIsCongByPosition($position) || $this->getIsKeByPosition($position)) {
            $conditions[] = '会因财务上的原因给事业运势带来压力，';
        } else {
            $conditions[] = '';
        }

        return $conditions;
    }

    protected function getIsCongByDate($dz)
    {
        return $this->isCongRelation($dz, $this->getDayDz()) || $this->isCongRelation($dz, $this->getMonthDz());
    }

    protected function judgeDateSixQin($six_qin)
    {
        return $six_qin == $this->getSixQinByDz($this->getDayDz()) || $six_qin == $this->getSixQinByDz($this->getMonthDz());
    }

    protected function getHelpers($guan_position, $fu_position)
    {
        // 日月官冲or日月子
        if ($this->getIsCongByDate($guan_position['dz']) || $this->judgeDateSixQin('子')) {
            return '事业贵人助力不稳定，容易有口角是非，需谨慎。';
        }

        // 日月父合入
        if ($this->getIsHeByPosition($fu_position, true) || $this->getIsRuByPosition($fu_position, true)) {
            return '贵人同时在帮助其他的项目，来助力量分散。';
        }

        // 日月兄冲
        $xiong_positions = $this->getGodPositionsWithSixQin('兄');
        $xiong_position = $xiong_positions[0];
        if ($this->getIsHeByPosition($xiong_position, true) || $this->getIsRuByPosition($xiong_position, true)) {
            return '事业助力会受到同行或竞争对手的影响。';
        }

        return '';
    }

    protected function getHelperMen($position)
    {
        $letters = [
            ['wx' => '木', 'letter' => '多?与有博爱、性情随和、感情丰富、心胸宽广的人链接有助事业运的增长。'],
            ['wx' => '火', 'letter' => '多?与彬彬有礼、性情刚烈、热情爽快、待人耿直的人链接有助事业运的增长。'],
            ['wx' => '土', 'letter' => '多?与忠厚老实、宽宏大量、踏实肯干、讲信守誉的人链接有助事业运的增长。'],
            ['wx' => '金', 'letter' => '多?与不卑不亢、行动稳成、刚毅果决、重情重义的人链接有助事业运的增长。'],
            ['wx' => '水', 'letter' => '多?与足智多谋、聪明好学、好动健谈、灵活多变的人链接有助事业运的增长。'],
        ];

        $row = collect($letters)->where('wx', $position['wx'])->first();

        $str = '';
        if ($this->getIsStaticYaoByPosition($position)) {
            $str = '主动';
        }

        return str_replace('?', $str, $row['letter']);
    }

    protected function getHelperDirections()
    {
        //官爻对应的十二地支的方向
        $positions = $this->getPositionsWithSixQin('官');
        $dzs = collect($positions)->pluck('dz')->unique()->toArray();

        $directions = [
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

        $directions = collect($directions)->whereIn('dz', $dzs)->pluck()->toArray();
        return '多往住家或办公室的' . implode('，', $directions) . '方向走动有助于事业运的发展。';
    }

    /**
     * @return string
     */
    protected function getHelperByDate()
    {
        //官
        $guan_positions = $this->getPositionsWithSixQin('官');
        $guan_dzs = collect($guan_positions)->pluck('dz')->unique()->toArray();

        //父
        $fu_positions = $this->getPositionsWithSixQin('父');
        $fu_dzs = collect($fu_positions)->pluck('dz')->unique()->toArray();

        $dzs = implode('，', array_unique(array_merge($guan_dzs, $fu_dzs)));
        return '事业运在' . $dzs . '月以及每月的' . $dzs . '日较旺。';
    }
}