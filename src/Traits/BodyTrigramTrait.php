<?php


namespace Maturest\Trigram\Traits;

use Illuminate\Support\Str;

trait BodyTrigramTrait
{

    /**
     * The function checks for blood stagnation in different body parts and provides recommendations
     * for better daily care, with an additional warning for potential serious conditions.
     *
     * @return a string that provides information about the presence of blood stasis in certain body
     * parts. The string includes recommendations for better daily care and, if applicable, a
     * suggestion to undergo a health check or seek medical attention if there are any discomfort or
     * concerns.
     */
    public function bodyHe()
    {
        $res = $this->getHeWx();

        if (empty($res)) {
            return false;
        }

        $wxs = collect($res)->pluck('wx')->unique()->toArray();
        $parts = $this->getParts($wxs);
        $str = "在{$parts}部位有气血淤堵的现象，建议更好的日常养护。";

        $serious = collect($res)->where('serious', true)->pluck('wx')->unique()->toArray();
        if ($serious) {
            $parts = $this->getParts($serious);
            $str .= "在{$parts}部位有气血淤堵的现象，恐有长硬物的隐患，建议进行健康检查，或有不适及时就医。";
        }

        return $str;
    }


    /**
     * The function "getParts" takes an array of weather conditions and returns a string containing the
     * corresponding body parts.
     *
     * @param wxs An array of elements representing the five elements (土, 金, 木, 水, 火).
     *
     * @return a string that contains the body parts associated with the given weather conditions. The
     * body parts are separated by commas.
     */
    protected function getParts($wxs)
    {
        $parts = [];

        $bodyParts = [
            ['wx' => '土', 'parts' => ['肠胃'],],
            ['wx' => '金', 'parts' => ['肺部'],],
            ['wx' => '木', 'parts' => ['肝脏'],],
            ['wx' => '水', 'parts' => ['肾脏', '血液'],],
            ['wx' => '火', 'parts' => ['心脏'],],
        ];

        foreach ($wxs as $wx) {
            $row = collect($bodyParts)->where('wx', $wx)->first();
            $parts = array_merge($parts, $row['parts']);
        }

        return implode('、', $parts);
    }


    /**
     * returns an array of information about positions based on the "six_he" array.
     *
     * @return an array of elements.
     */
    protected function getHeWx()
    {
        if (empty($this->draw['six_he'])) {
            return [];
        }

        $allPositions = $this->getAllPosition();

        $res = [];

        foreach ($this->draw['six_he'] as $six_he) {
            $tmp = [];
            $positions = explode('-', $six_he);
            foreach ($positions as $position) {
                $row = collect($allPositions)->where('column', $position[0])->where('row', $position[1])->first();
                $tmp['wx'] = $this->getWxByDz($row['dz']);
                $tmp['serious'] = '官' == $this->getSixQinByDz($row['dz']);
                $res[] = $tmp;
            }
        }

        return $res;
    }

    public function bodyChong()
    {
        $res = [];

        $six_chong = $this->draw['six_chong'];

        //1、merge handel dark on
        $coords = $this->draw['an_dong']['coords'];
        foreach ($coords as $coords) {
            $six_chong[] = '62-' . ($coords - 40);
        }

        $res = [];

        $allPositions = $this->getAllPosition();
        foreach ($six_chong as $arr) {
            $positions = explode('-', $arr);

            //start point
            $point_a = $positions[0];
            //end point
            $point_b = $positions[1];

            $row_a = collect($allPositions)->where('column', $point_a[0])->where('row', $point_a[1])->first();

            // 如果是辰戌、丑未冲
            if (in_array($row_a['dz'], ['辰', '戌', '丑', '未'])) {
                $res[] = '注意饮食和脾胃的调理，或有消化不良导致的肠胃胀气现象。';
            }

            // 如果是子午、巳亥冲，并且动爻对应的地支是午或巳，
            if (in_array($row_a['dz'], ['子', '午', '巳', '亥'])) {
                $row_b = collect($allPositions)->where('column', $point_b[0])->where('row', $point_b[1])->first();
                if (($point_a[0] == 6 && in_array($row_a['dz'], ['午', '巳']))
                    || ($point_b[0] == 6 && in_array($row_b['dz'], ['午', '巳']))
                ) {
                    $res[] = '注意身体的炎症隐患，避免由炎症引起的发热现象。';
                } else {
                    $res[] = '身体有炎症的隐患，易有心悸或伤寒发热的现象，注意心脏的养护。';
                }
            }

            // 如果是卯酉，寅申冲并且动爻对应的地支是卯或申
            if (in_array($row_a['dz'], ['卯', '酉', '寅', '申',])) {
                $row_b = collect($allPositions)->where('column', $point_b[0])->where('row', $point_b[1])->first();
                if (($point_a[0] == 6 && in_array($row_a['dz'], ['卯', '申']))
                    || ($point_b[0] == 6 && in_array($row_b['dz'], ['卯', '申']))
                ) {
                    $res[] = '注意肝脏的保养，神经性问题的隐患，避免脊柱侧弯或四肢受伤的现象。';
                } else {
                    $res[] = '注意或有脊柱侧弯的可能，避免四肢受伤的现象，注意肝胆养护。';
                }
            }
        }

        return array_unique($res);
    }

    public function getAllKeByDongAsTaiJiPoint()
    {
        $dong_wxs = $this->getDongYaoWx();
        $trans_wxs = $this->getTransYaoWx();
        $date_wxs = $this->getDateWx();
        $hui_wxs = $this->getHuiJuWx();

        $dong_ke_dong = $this->getKeRelations($dong_wxs, $dong_wxs);
        $trans_ke_dong = $this->getKeDongByTrans();
        $date_ke_dong = $this->getKeRelations($dong_wxs, $date_wxs);
        $date_ke_trans = $this->getKeRelations($trans_wxs, $date_wxs);
        $hui_ke_dong = $this->getKeRelations($dong_wxs, $hui_wxs);

        $wxs = array_merge($dong_ke_dong, $trans_ke_dong, $date_ke_dong, $date_ke_trans, $hui_ke_dong);
        $wxs = collect($wxs)->unique()->toArray();
        return $wxs;
    }

    public function bodyKe()
    {
        $letters = [
            ['wx' => '木', 'ke' => '土', 'letter' => '注意肠胃的保养，避免有肠胃息肉的隐患。'],
            ['wx' => '土', 'ke' => '水', 'letter' => '血液循环有不通畅的现象，或有湿疹的可能性，注意肾脏及泌尿系统的保养。'],
            ['wx' => '水', 'ke' => '火', 'letter' => '身体有炎症的隐患，易有心悸或伤寒发热的现象，注意心脏的保养。'],
            ['wx' => '火', 'ke' => '金', 'letter' => '容易有经络不通的情况，注意避免筋骨受损，建议做好肺部的健康保养。'],
            ['wx' => '金', 'ke' => '木', 'letter' => '注意肝胆的养护，避免四肢的磕磕碰碰。'],
        ];

        $wxs = $this->getAllKeByDongAsTaiJiPoint();

        $res = [];
        foreach ($wxs as $wx) {
            $row = collect($letters)->where('wx', $wx[0])->where('ke', $wx[1])->first();
            $res[] = $row['letter'];
        }
        return $res;
    }

    public function bodyEmptyDeathOrTomb()
    {
        $letters = [
            ['wx' => '金', 'letter' => '目前肺气偏弱，?经络不通。'],
            ['wx' => '木', 'letter' => '目前肝胆气偏弱，四肢有乏力的现象。'],
            ['wx' => '水', 'letter' => '目前肾脏气偏弱，血液循环不通。'],
            ['wx' => '火', 'letter' => '目前的心脏能量偏弱，内火不足。'],
            ['wx' => '土', 'letter' => '目前脾胃气偏弱。'],
        ];

        $positions = collect($this->draw['kong_wang']['coords'])->pluck('position')->toArray();
        $tmp_positions = $this->draw['ru_mu'];
        foreach ($tmp_positions as $tmp_position) {
            $tmp = explode('-', $tmp_position);
            $positions[] = $tmp[1];
        }

        $allPositions = $this->getAllPosition();

        $gold = [];
        $res = [];
        foreach ($positions as $position) {
            $row = collect($allPositions)->where('column', $position[0])->where('row', $position[1])->first();

            $wx = $this->getWxByDz($row['dz']);

            if ($wx == '金') {
                if (in_array($position[1], [1, 2])) {
                    $gold[] = '头部、颈部';
                }

                if (in_array($position[1], [3, 4])) {
                    $gold[] = '背部、腹部';
                }

                if (in_array($position[1], [5, 6])) {
                    $gold[] = '腿脚部位';
                }
            }

            $letter = collect($letters)->where('wx', $wx)->first();

            $res[] = $letter['letter'];
        }

        $res = array_unique($res);

        if ($gold) {
            $str = Str::replaceFirst('?', implode('、', $gold), implode('-', $res));
            $res = explode('-', $str);
        }

        return $res;
    }

    public function bodyKeInnerTrigram()
    {
        $res = [];

        $day_dz = $this->getDayDz();
        $day_wx = $this->getDayWx();

        $month_dz = $this->getMonthDz();
        $month_wx = $this->getMonthWx();

        $dong_wxs = $this->getDongYaoWx();

        $day_ke = $this->getKeRelations($dong_wxs, [$day_wx]);
        $month_ke = $this->getKeRelations($dong_wxs, [$month_wx]);

        $directions = [
            ['dz' => '丑', 'direction' => '东北'],
            ['dz' => '辰', 'direction' => '东南'],
            ['dz' => '未', 'direction' => '西南'],
        ];

        if ($day_ke && !$month_ke) {
            if (in_array($day_dz, ['戌', '亥'])) {
                $res[] = '有受到西北方五黄煞能量影响，建议择日化解家中五黄煞对我家运有助。卜卦问句为：何日化解家中五黄煞对我家运有助？';
            }

            if (in_array($day_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $day_dz)->first();
                $res[] = "有受到{$row[$day_dz]}方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？";
            }
        }

        if ($month_ke && !$day_ke) {
            if (in_array($month_dz, ['戌', '亥'])) {
                $res[] = '有受到西北方五黄煞能量影响，建议择日化解家中五黄煞对我家运有助。卜卦问句为：何日化解家中五黄煞对我家运有助？';
            }

            if (in_array($month_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $month_dz)->first();
                $res[] = "有受到{$row[$month_dz]}方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？";
            }
        }

        if ($day_ke && $month_ke) {
            if (in_array($day_dz, ['戌', '亥']) && in_array($month_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $month_dz)->first();
                $res[] = "有受到{$row[$month_dz]}方位的动土能量影响，及西北方五黄煞能量影响，建议择日净化家中磁场及化解家中五黄煞对我家运有助。卜卦问句为：何日净化家中磁场及化解家中五黄煞对我家运有助？";
            }

            if (in_array($month_dz, ['戌', '亥']) && in_array($day_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $day_dz)->first();
                $res[] = "有受到{$row[$day_dz]}方位的动土能量影响，及西北方五黄煞能量影响，建议择日净化家中磁场及化解家中五黄煞对我家运有助。卜卦问句为：何日净化家中磁场及化解家中五黄煞对我家运有助？";
            }

            if (in_array($day_dz, ['戌', '亥']) && in_array($month_dz, ['戌', '亥'])) {
                $res[] = '有受到西北方五黄煞能量影响，建议择日化解家中五黄煞对我家运有助。卜卦问句为：何日化解家中五黄煞对我家运有助？';
            }

            if (in_array($day_dz, ['丑', '辰', '未']) && in_array($month_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $month_dz)->first();
                $res[] = "有受到{$row[$month_dz]}方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？";
            }
        }

        return $res;
    }

    protected function handleUnborn($wx)
    {
        $letters = [
            ['wx' => '木', 'letter' => '建议您去庙里拜神农大帝，请婴灵去报到。'],
            ['wx' => '火', 'letter' => '建议您去庙里拜关圣帝君，请婴灵去报到。'],
            ['wx' => '土', 'letter' => '建议您去庙里拜地藏王菩萨，请婴灵去报到。'],
            ['wx' => '金', 'letter' => '建议您去庙里拜观世音菩萨，请婴灵去报到。'],
            ['wx' => '水', 'letter' => '建议您去庙里拜玄天上帝，请婴灵去报到。'],
        ];

        $letter = collect($letters)->where('wx', $wx)->first();

        return $letter['letter'] . "（to解卦人温馨提醒：请自行谨慎判断不适宜送婴灵的具体情况，或是否可以用直接化煞替代。阅后请自行删除。）";
    }

    public function bodyUnborn()
    {
        $guan_positions = $this->getPositionsWithSixQin('官');
        $brother_positions = $this->getPositionsWithSixQin('兄');
        $child_positions = $this->getPositionsWithSixQin('子');

        foreach ($guan_positions as $position) {
            if ($position['is_dong'] || $position['is_an_dong']) {
                if ($this->getIsHeByPosition($position)) {
                    if (
                        $this->isNeedUnborn($position, $brother_positions, 'six_he')
                        || $this->isNeedUnborn($position, $child_positions, 'six_he')
                    ) {
                        return $this->handleUnborn($child_positions[0]['wx']);
                    }
                }
            }

            if ($this->getIsCongByPosition($position)) {
                if (
                    $this->isNeedUnborn($position, $brother_positions, 'six_chong')
                    || $this->isNeedUnborn($position, $child_positions, 'six_chong')
                ) {
                    return $this->handleUnborn($child_positions[0]['wx']);
                }
            }

            if ($this->getIsRuByPosition($position)) {
                if (
                    $this->isNeedUnborn($position, $brother_positions, 'ru_mu')
                    || $this->isNeedUnborn($position, $child_positions, 'ru_mu')
                ) {
                    return $this->handleUnborn($child_positions[0]['wx']);
                }
            }
        }

        if ($this->getKeRelations([$this->getGodWx()], [$child_positions[0]['wx']])) {
            return $this->handleUnborn($brother_positions[0]['wx']);
        }

        return '';
    }

    public function bodyYing()
    {
        $six_qin_ying = $this->getSixQinByShiOrYing('应');
        $six_qin_shi = $this->getSixQinByShiOrYing('世');


        $day_dz = $this->getDayDz();
        $day_wx = $this->getDayWx();
        $month_dz = $this->getMonthDz();
        $month_wx = $this->getMonthWx();
        $dong_wxs = $this->getDongYaoWx();
        $day_ke = $this->getKeRelations($dong_wxs, [$day_wx]);
        $month_ke = $this->getKeRelations($dong_wxs, [$month_wx]);

        $str1 = '住家门口磁场有扬升空间，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
        $str2 = '家门口能量场有扬升空间，或有受到外部磁场能量影响，建议您择日讲话住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
        $str3 = '家门口能量场有扬升空间，position方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
        $directions = [
            ['dz' => '丑', 'direction' => '东北'],
            ['dz' => '辰', 'direction' => '东南'],
            ['dz' => '未', 'direction' => '西南'],
        ];
        $positions = [];

        if ($six_qin_ying == '官') {
            if (in_array($six_qin_shi, ['兄', '子', '财', '父'])) {
                return $str1;
            }

            if ($day_ke && in_array($day_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $day_dz)->first();
                $positions[] = $row['direction'];
            }

            if ($month_ke && in_array($month_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $month_dz)->first();
                $positions[] = $row['direction'];
            }

            if ($day_ke || $month_ke) {
                if ($positions) {
                    return Str::replaceFirst('position', implode('、', $positions), $str3);
                }
                return $str2;
            }
        }

        if ($six_qin_ying == '兄') {
            if (in_array($six_qin_shi, ['兄', '财', '父'])) {
                return $str1;
            }

            if ($day_ke && in_array($day_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $day_dz)->first();
                $positions[] = $row['direction'];
            }

            if ($month_ke && in_array($month_dz, ['丑', '辰', '未'])) {
                $row = collect($directions)->where('dz', $month_dz)->first();
                $positions[] = $row['direction'];
            }

            if ($day_ke || $month_ke) {
                if ($positions) {
                    return Str::replaceFirst('position', implode('、', $positions), $str3);
                }
                return $str2;
            }
        }

        return '';
    }
}
