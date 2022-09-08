<?php


namespace Maturest\Trigram\Traits\Destiny;


trait SixHeTrait
{
    // 六合
    protected $sixHe = [
        ['子', '丑'],
        ['寅', '亥'],
        ['卯', '戌'],
        ['辰', '酉'],
        ['巳', '申'],
        ['午', '未'],
    ];

    // 先按类别，然后再按论关系的纬度
    protected $sixHeImages = [
        //本爻与本爻
        '41-42' => ['left_top' => ['148', '155'], 'img' => 'six_he/11-12.png', 'middle' => ['138', '204'], 'mid_img' => 'fonts/he.png'],
        '41-43' => ['left_top' => ['121', '153'], 'img' => 'six_he/11-13.png', 'middle' => ['112', '255'], 'mid_img' => 'fonts/he.png'],
        '41-44' => ['left_top' => ['94', '153'], 'img' => 'six_he/11-14.png', 'middle' => ['86', '322'], 'mid_img' => 'fonts/he.png'],
        '41-45' => ['left_top' => ['68', '152'], 'img' => 'six_he/11-15.png', 'middle' => ['72', '396'], 'mid_img' => 'fonts/he.png'],
        '41-46' => ['left_top' => ['53', '151'], 'img' => 'six_he/11-16.png', 'middle' => ['43', '454'], 'mid_img' => 'fonts/he.png'],
        '42-43' => ['left_top' => ['148', '277'], 'img' => 'six_he/12-13.png', 'middle' => ['138', '327'], 'mid_img' => 'fonts/he.png'],
        '42-44' => ['left_top' => ['120', '278'], 'img' => 'six_he/12-14.png', 'middle' => ['111', '384'], 'mid_img' => 'fonts/he.png'],
        '42-45' => ['left_top' => ['97', '277'], 'img' => 'six_he/12-15.png', 'middle' => ['89', '460'], 'mid_img' => 'fonts/he.png'],
        '42-46' => ['left_top' => ['81', '275'], 'img' => 'six_he/12-16.png', 'middle' => ['72', '495'], 'mid_img' => 'fonts/he.png'],
        '43-44' => ['left_top' => ['148', '407'], 'img' => 'six_he/13-14.png', 'middle' => ['138', '457'], 'mid_img' => 'fonts/he.png'],
        '43-45' => ['left_top' => ['115', '407'], 'img' => 'six_he/13-15.png', 'middle' => ['106', '516'], 'mid_img' => 'fonts/he.png'],
        '43-46' => ['left_top' => ['82', '407'], 'img' => 'six_he/13-16.png', 'middle' => ['74', '584'], 'mid_img' => 'fonts/he.png'],
        '44-45' => ['left_top' => ['148', '530'], 'img' => 'six_he/14-15.png', 'middle' => ['138', '580'], 'mid_img' => 'fonts/he.png'],
        '44-46' => ['left_top' => ['115', '530'], 'img' => 'six_he/14-16.png', 'middle' => ['106', '639'], 'mid_img' => 'fonts/he.png'],
        '45-46' => ['left_top' => ['148', '652'], 'img' => 'six_he/15-16.png', 'middle' => ['138', '701'], 'mid_img' => 'fonts/he.png'],
        //本爻与化爻
        '41-51' => ['left_top' => ['392', '146'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '130'], 'font' => '合'],
        '42-52' => ['left_top' => ['392', '268'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '252'], 'font' => '合'],
        '43-53' => ['left_top' => ['392', '391'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '375'], 'font' => '合'],
        '44-54' => ['left_top' => ['392', '513'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '497'], 'font' => '合'],
        '45-55' => ['left_top' => ['392', '636'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '620'], 'font' => '合'],
        '46-56' => ['left_top' => ['392', '758'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '742'], 'font' => '合'],
        //本爻与月令
        '61-41' => ['left_top' => ['383', '173'], 'img' => 'six_he/61-41.png', 'middle' => ['485', '192'], 'mid_img' => 'fonts/he.png'],
        '61-42' => ['left_top' => ['378', '230'], 'img' => 'six_he/61-42.png', 'middle' => ['464', '224'], 'mid_img' => 'fonts/he.png'],
        '61-43' => ['left_top' => ['387', '244'], 'img' => 'six_he/61-43.png', 'middle' => ['488', '286'], 'mid_img' => 'fonts/he.png'],
        '61-44' => ['left_top' => ['383', '269'], 'img' => 'six_he/61-44.png', 'middle' => ['484', '408'], 'mid_img' => 'fonts/he.png'],
        '61-45' => ['left_top' => ['384', '291'], 'img' => 'six_he/61-45.png', 'middle' => ['488', '508'], 'mid_img' => 'fonts/he.png'],
        '61-46' => ['left_top' => ['382', '314'], 'img' => 'six_he/61-46.png', 'middle' => ['507', '588'], 'mid_img' => 'fonts/he.png'],
        //本爻与日令
        '62-41' => ['left_top' => ['385', '168'], 'img' => 'six_he/62-41.png', 'middle' => ['498', '293'], 'mid_img' => 'fonts/he.png'],
        '62-42' => ['left_top' => ['386', '296'], 'img' => 'six_he/62-42.png', 'middle' => ['495', '401'], 'mid_img' => 'fonts/he.png'],
        '62-43' => ['left_top' => ['388', '422'], 'img' => 'six_he/62-43.png', 'middle' => ['496', '460'], 'mid_img' => 'fonts/he.png'],
        '62-44' => ['left_top' => ['390', '537'], 'img' => 'six_he/62-44.png', 'middle' => ['486', '545'], 'mid_img' => 'fonts/he.png'],
        '62-45' => ['left_top' => ['381', '553'], 'img' => 'six_he/62-45.png', 'middle' => ['463', '576'], 'mid_img' => 'fonts/he.png'],
        '62-46' => ['left_top' => ['382', '565'], 'img' => 'six_he/62-46.png', 'middle' => ['483', '651'], 'mid_img' => 'fonts/he.png'],
        //化爻与月令
        '61-51' => ['left_top' => ['491', '159'], 'img' => 'six_he/61-51.png', 'middle' => ['526', '178'], 'mid_img' => 'fonts/he.png'],
        '61-52' => ['left_top' => ['489', '233'], 'img' => 'six_he/61-52.png', 'middle' => ['525', '246'], 'mid_img' => 'fonts/he.png'],
        '61-53' => ['left_top' => ['485', '249'], 'img' => 'six_he/61-53.png', 'middle' => ['516', '315'], 'mid_img' => 'fonts/he.png'],
        '61-54' => ['left_top' => ['484', '271'], 'img' => 'six_he/61-54.png', 'middle' => ['519', '393'], 'mid_img' => 'fonts/he.png'],
        '61-55' => ['left_top' => ['482', '293'], 'img' => 'six_he/61-55.png', 'middle' => ['520', '464'], 'mid_img' => 'fonts/he.png'],
        '61-56' => ['left_top' => ['482', '311'], 'img' => 'six_he/61-56.png', 'middle' => ['525', '536'], 'mid_img' => 'fonts/he.png'],
        //化爻与日令
        '62-51' => ['left_top' => ['482', '158'], 'img' => 'six_he/62-51.png', 'middle' => ['529', '310'], 'mid_img' => 'fonts/he.png'],
        '62-52' => ['left_top' => ['482', '283'], 'img' => 'six_he/62-52.png', 'middle' => ['524', '376'], 'mid_img' => 'fonts/he.png'],
        '62-53' => ['left_top' => ['485', '404'], 'img' => 'six_he/62-53.png', 'middle' => ['523', '444'], 'mid_img' => 'fonts/he.png'],
        '62-54' => ['left_top' => ['485', '522'], 'img' => 'six_he/62-54.png', 'middle' => ['521', '520'], 'mid_img' => 'fonts/he.png'],
        '62-55' => ['left_top' => ['489', '537'], 'img' => 'six_he/62-55.png', 'middle' => ['525', '580'], 'mid_img' => 'fonts/he.png'],
        '62-56' => ['left_top' => ['491', '554'], 'img' => 'six_he/62-56.png', 'middle' => ['526', '647'], 'mid_img' => 'fonts/he.png'],

    ];

    /**
     * 处理六合的原则和六冲是一致的
     */
    public function handleRelationSixHe()
    {
        // 1、本爻与本爻 (必须是动爻才可以)
        $benGuaSixHeSelf = $this->getSixHeByBenGua();

        // 2、本爻与自己的化爻
        $benGuaHeTrans = $this->getSixHeBenAndTrans();

        // 3、日令与本爻
        $dayHeBenGua = $this->getSixHeDay2Ben();

        // 4、日令与化爻
        $dayHeTransGua = $this->getSixHeDay2Trans();

        // 5、月令与本爻
        $monthHeBenGua = $this->getSixHeMonth2Ben();

        // 6、月令与化爻
        $monthHeTransGua = $this->getSixHeMonth2Trans();

        $this->draw['six_he'] = array_merge($benGuaSixHeSelf, $benGuaHeTrans, $dayHeBenGua,
            $dayHeTransGua, $monthHeBenGua, $monthHeTransGua);

        return $this;

    }

    public function getSixHeByBenGua()
    {
        $dongs = $this->getBenDong();

        $he = [];

        $count = count($dongs);

        if ($count > 1) {
            foreach ($dongs as $key => $dong) {
                //六合暗动不能是起始点
                if ($dong['is_an_dong']) {
                    continue;
                }

                // 每从地支里拿出来一个，就要与对应的比
                $start = $key + 1;
                for ($i = $start; $i < $count; $i++) {
                    if ($this->isHeRelation($dong['dz'], $dongs[$i]['dz'])) {
                        $he[] = $dong['column'] . $dong['row'] . '-' . $dongs[$i]['column'] . $dongs[$i]['row'];
                    }
                }
            }
        }

        return $he;
    }

    /**
     * @param $a
     * @param $b
     * @return bool
     */
    public function isHeRelation($a, $b)
    {
        return in_array([$a, $b], $this->sixHe) || in_array([$b, $a], $this->sixHe);
    }

    public function getSixHeBenAndTrans()
    {
        // 如果存在化爻
        if ($this->transGuaExists()) {
            $he = [];
            // 本卦地支数组
            $ben_arr = $this->diZhi2Arr($this->resultDiZhi['di_zhi']);
            // 化爻地支数组
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);

            foreach ($ben_arr as $key => $val) {
                if ($this->isHeRelation($val, $trans_arr[$key])) {
                    $position = $key + 1;
                    $he[] = '4' . $position . '-' . '5' . $position;
                }
            }
            return $he;
        }
        return [];
    }

    public function getSixHeDay2Ben()
    {
        $dongs = $this->getBenDong();
        $he = [];
        foreach ($dongs as $dong) {

            if ($dong['is_an_dong']) {
                continue;
            }

            if ($this->isHeRelation($this->diZhiDay, $dong['dz'])) {
                $he[] = '62-' . $dong['column'] . $dong['row'];
            }
        }
        return $he;
    }

    public function getSixHeDay2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getHeByDate($this->diZhiDay, $trans_arr, '62', '5');
        }
        return [];
    }

    public function getHeByDate($date_di_zhi, $di_zhi_arr, $start, $column)
    {
        $he = [];
        foreach ($di_zhi_arr as $key => $value) {
            if ($this->isHeRelation($value, $date_di_zhi)) {
                $position = $key + 1;
                $he[] = $start . '-' . $column . $position;
            }
        }
        return $he;
    }

    public function getSixHeMonth2Ben()
    {
        $dongs = $this->getBenDong();
        $he = [];
        foreach ($dongs as $dong) {

            if ($dong['is_an_dong']) {
                continue;
            }

            if ($this->isHeRelation($this->diZhiMonth, $dong['dz'])) {
                $he[] = '61-' . $dong['column'] . $dong['row'];
            }
        }
        return $he;
    }

    public function getSixHeMonth2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getHeByDate($this->diZhiMonth, $trans_arr, '61', '5');
        }
        return [];
    }


}
