<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait CauseTrait
{

    /**
     * > It returns an array of strings that are the cause of the father's problem
     *
     * @param is_student if true, the student's cause will be included.
     * @return array
     */
    public function cause($is_student = false)
    {
        $letters = [];

        $positions = $this->getGodPositionsWithSixQin('父');
        $position = $positions[0];

        if ($is_student) {
            $letters[] = $this->getStudentCause($position);
        }

        $letters[] = $this->getCaseLevel($position);

        $guan_positions = $this->getGodPositionsWithSixQin('官');
        $guan_position = $guan_positions[0];

        $letters[] = $this->getHelpers($guan_position, $position);

        $letters[] = $this->getHelperMen($guan_position);

        $letters[] = $this->getHelperDirections();

        $letters[] = $this->getHelperByDate();

        return array_filter($letters);
    }

    /**
     * @param $position
     * @return string
     */
    protected function getStudentCause($position)
    {
        if ($this->getIsKeByPosition($position)) {
            $tmp_arr = [];
            $tmp_arr[] = '今年在学业上会有不稳定的现象，成绩上会有起伏。';

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
     * > It returns an array of letters that are related to the given position
     *
     * @param position the position of the current character
     * @param font the font of the position
     * @param letter the letter of the position
     * @return array
     */
    protected function getStudyInfo($position, $font, $letter)
    {
        $res = [];
        $six_qin_positions = $this->getPositionsWithSixQin($font, true);
        foreach ($six_qin_positions as $six_qin_position) {
            if ($this->isCongRelation($position['dz'], $six_qin_position['dz'])) {
                $res[] = $letter;
            };

            if ($six_qin_position['wx'] == $this->getWhoKeMe($position['wx'])) {
                $res[] = $letter;
            }

            if ($this->isHeRelation($position['dz'], $six_qin_position['dz'])) {
                $res[] = $letter;
            }

            if ($this->isRuRelation($position, $six_qin_position)) {
                $res[] = $letter;
            }
        }

        return array_unique($res);
    }

    /**
     * > The function returns the cause level and cause flow of a position
     *
     * @param position The position of the case in the case list.
     *
     * @return The case level and the case flow.
     */
    protected function getCaseLevel($position)
    {
        return $this->causeLevel($position) . $this->causeFlow($position);
    }


    /**
     * > If the position has no Ke, and the position is HuiJu and the date is growing and equal, or the
     * position is HuiJu and the date is growing and equal, or the date is growing and equal and the
     * position is growing and equal, then the career is very strong
     *
     * @param position the position of the person in the chart
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

    /**
     * It returns a string.
     *
     * @param position the position of the hexagram in the sequence of 64 hexagrams.
     *
     * @return The method is returning a string.
     */
    protected function causeFlow($position)
    {
        if ($this->hasOneKeCongHeRu($position)) {
            $str = '事业或投资上有震荡起伏，有不稳定因素，???项目的选择上需多谨慎，必要时建议可多方面卜卦确认。';
            $causeConditions = $this->causeConditions($position);
            return Str::replaceArray('?', $causeConditions, $str);
        }

        return '事业亨通，可做好事业的规划或者投资的管理，是事业扬升的好时机，可好好把握。';
    }

    /**
     * > It returns an array of strings, each of which is a sentence describing the conditions of the
     * career
     *
     * @param position the position of the god
     * @return array
     */
    protected function causeConditions($position)
    {
        $conditions = [];

        $str = '';

        if ($this->getIsDongYaoByPosition($position)
            && $this->getIsCongByDate($position['dz'])
        ) {
            $str .= '容易因多个事业项目之间的冲突照成麻烦。';
        }

        if ($this->judgeDateSixQin('官') && ($this->getIsHeByPosition($position, true) || $this->getIsRuByPosition($position, true))) {
            $str .= '事业会陷入不必要的是非甚至官非中。';
        }

        $xiong_positions = $this->getGodPositionsWithSixQin('兄');
        $xiong_position = $xiong_positions[0];
        if ($this->getIsHeByPosition($xiong_position, true) || $this->getIsRuByPosition($xiong_position, true)) {
            $str .= '事业项目会有被同行或竞争对手截胡的可能。';
        }

        $conditions[] = $str;

        if ($this->getIsKongWangByPosition($position) || $this->getIsRuByPosition($position) || $this->getIsHeByPosition($position)) {
            $conditions[] = '会有停滞或越做越小的情况，';
        } else {
            $conditions[] = '';
        }

        if ($this->getIsCongByPosition($position) || $this->getIsKeByPosition($position)) {
            $conditions[] = '会因财务上的原因给事业运势带来压力，';
        } else {
            $conditions[] = '';
        }

        return $conditions;
    }

    /**
     * It checks if the day or month is a cong.
     *
     * @param dz the day of the month
     * @return boolean
     */
    protected function getIsCongByDate($dz)
    {
        return $this->isCongRelation($dz, $this->getDayDz()) || $this->isCongRelation($dz, $this->getMonthDz());
    }

    /**
     * It returns true if the six_qin is the same as the day or month dz.
     *
     * @param six_qin the six qin of the day
     * @return boolean
     */
    protected function judgeDateSixQin($six_qin)
    {
        return $six_qin == $this->getSixQinByDz($this->getDayDz()) || $six_qin == $this->getSixQinByDz($this->getMonthDz());
    }

    /**
     * > If the `guan_position` is in the `cong` position, or the `guan_position` is in the `zi`
     * position, then return `事业贵人助力不稳定，容易有口角是非，需谨慎。`; if the `fu_position` is in the `he` position, or
     * the `fu_position` is in the `ru` position, then return `贵人同时在帮助其他的项目，来助力量分散。`; if the
     * `xiong_position` is in the `he` position, or the `xiong_position` is in the `ru` position, then
     *
     * @param guan_position the position of the guan (官) god
     * @param fu_position the position of the fu god
     * @return string
     */
    protected function getHelpers($guan_position, $fu_position)
    {
        if ($this->getIsCongByDate($guan_position['dz']) || $this->judgeDateSixQin('子')) {
            return '事业贵人助力不稳定，容易有口角是非，需谨慎。';
        }

        if ($this->getIsHeByPosition($fu_position, true) || $this->getIsRuByPosition($fu_position, true)) {
            return '贵人同时在帮助其他的项目，来助力量分散。';
        }

        $xiong_positions = $this->getGodPositionsWithSixQin('兄');
        $xiong_position = $xiong_positions[0];
        if ($this->getIsHeByPosition($xiong_position, true) || $this->getIsRuByPosition($xiong_position, true)) {
            return '事业助力会受到同行或竞争对手的影响。';
        }

        return '';
    }

    /**
     * > This function returns a string that describes the type of people that will help the user's
     * career
     *
     * @param position The position of the hexagram.
     * @return string
     */
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

    /**
     * > Get the directions of the positions with six qin
     * @return string
     */
    protected function getHelperDirections()
    {
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

        $directions = collect($directions)->whereIn('dz', $dzs)->pluck('direction')->unique()->toArray();
        return '多往住家或办公室的' . implode('，', $directions) . '方向走动有助于事业运的发展。';
    }


    /**
     * > Get the positions of the six qin of guan and fu, then get the unique dzs of the positions,
     * then merge the two arrays, then get the unique dzs, then implode the dzs with '，', then return
     * the sentence
     *
     * @return string
     */
    protected function getHelperByDate()
    {
        $guan_positions = $this->getPositionsWithSixQin('官');
        $guan_dzs = collect($guan_positions)->pluck('dz')->unique()->toArray();

        $fu_positions = $this->getPositionsWithSixQin('父');
        $fu_dzs = collect($fu_positions)->pluck('dz')->unique()->toArray();

        $dzs = implode('，', array_unique(array_merge($guan_dzs, $fu_dzs)));
        return '事业运在' . $dzs . '月以及每月的' . $dzs . '日较旺。';
    }
}