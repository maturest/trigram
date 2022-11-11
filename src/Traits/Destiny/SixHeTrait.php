<?php


namespace Maturest\Trigram\Traits\Destiny;


trait SixHeTrait
{
    protected $sixHe = [
        ['子', '丑'],
        ['寅', '亥'],
        ['卯', '戌'],
        ['辰', '酉'],
        ['巳', '申'],
        ['午', '未'],
    ];


    protected $sixHeImages = [

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

        '41-51' => ['left_top' => ['392', '146'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '130'], 'font' => '合'],
        '42-52' => ['left_top' => ['392', '268'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '252'], 'font' => '合'],
        '43-53' => ['left_top' => ['392', '391'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '375'], 'font' => '合'],
        '44-54' => ['left_top' => ['392', '513'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '497'], 'font' => '合'],
        '45-55' => ['left_top' => ['392', '636'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '620'], 'font' => '合'],
        '46-56' => ['left_top' => ['392', '758'], 'img' => 'six_he/41-51.png', 'middle' => ['405', '742'], 'font' => '合'],

        '61-41' => ['left_top' => ['383', '173'], 'img' => 'six_he/61-41.png', 'middle' => ['485', '192'], 'mid_img' => 'fonts/he.png'],
        '61-42' => ['left_top' => ['378', '230'], 'img' => 'six_he/61-42.png', 'middle' => ['464', '224'], 'mid_img' => 'fonts/he.png'],
        '61-43' => ['left_top' => ['387', '244'], 'img' => 'six_he/61-43.png', 'middle' => ['488', '286'], 'mid_img' => 'fonts/he.png'],
        '61-44' => ['left_top' => ['383', '269'], 'img' => 'six_he/61-44.png', 'middle' => ['484', '408'], 'mid_img' => 'fonts/he.png'],
        '61-45' => ['left_top' => ['384', '291'], 'img' => 'six_he/61-45.png', 'middle' => ['488', '508'], 'mid_img' => 'fonts/he.png'],
        '61-46' => ['left_top' => ['382', '314'], 'img' => 'six_he/61-46.png', 'middle' => ['507', '588'], 'mid_img' => 'fonts/he.png'],

        '62-41' => ['left_top' => ['385', '168'], 'img' => 'six_he/62-41.png', 'middle' => ['498', '293'], 'mid_img' => 'fonts/he.png'],
        '62-42' => ['left_top' => ['386', '296'], 'img' => 'six_he/62-42.png', 'middle' => ['495', '401'], 'mid_img' => 'fonts/he.png'],
        '62-43' => ['left_top' => ['388', '422'], 'img' => 'six_he/62-43.png', 'middle' => ['496', '460'], 'mid_img' => 'fonts/he.png'],
        '62-44' => ['left_top' => ['390', '537'], 'img' => 'six_he/62-44.png', 'middle' => ['486', '545'], 'mid_img' => 'fonts/he.png'],
        '62-45' => ['left_top' => ['381', '553'], 'img' => 'six_he/62-45.png', 'middle' => ['463', '576'], 'mid_img' => 'fonts/he.png'],
        '62-46' => ['left_top' => ['382', '565'], 'img' => 'six_he/62-46.png', 'middle' => ['483', '651'], 'mid_img' => 'fonts/he.png'],

        '61-51' => ['left_top' => ['491', '159'], 'img' => 'six_he/61-51.png', 'middle' => ['526', '178'], 'mid_img' => 'fonts/he.png'],
        '61-52' => ['left_top' => ['489', '233'], 'img' => 'six_he/61-52.png', 'middle' => ['525', '246'], 'mid_img' => 'fonts/he.png'],
        '61-53' => ['left_top' => ['485', '249'], 'img' => 'six_he/61-53.png', 'middle' => ['516', '315'], 'mid_img' => 'fonts/he.png'],
        '61-54' => ['left_top' => ['484', '271'], 'img' => 'six_he/61-54.png', 'middle' => ['519', '393'], 'mid_img' => 'fonts/he.png'],
        '61-55' => ['left_top' => ['482', '293'], 'img' => 'six_he/61-55.png', 'middle' => ['520', '464'], 'mid_img' => 'fonts/he.png'],
        '61-56' => ['left_top' => ['482', '311'], 'img' => 'six_he/61-56.png', 'middle' => ['525', '536'], 'mid_img' => 'fonts/he.png'],

        '62-51' => ['left_top' => ['482', '158'], 'img' => 'six_he/62-51.png', 'middle' => ['529', '310'], 'mid_img' => 'fonts/he.png'],
        '62-52' => ['left_top' => ['482', '283'], 'img' => 'six_he/62-52.png', 'middle' => ['524', '376'], 'mid_img' => 'fonts/he.png'],
        '62-53' => ['left_top' => ['485', '404'], 'img' => 'six_he/62-53.png', 'middle' => ['523', '444'], 'mid_img' => 'fonts/he.png'],
        '62-54' => ['left_top' => ['485', '522'], 'img' => 'six_he/62-54.png', 'middle' => ['521', '520'], 'mid_img' => 'fonts/he.png'],
        '62-55' => ['left_top' => ['489', '537'], 'img' => 'six_he/62-55.png', 'middle' => ['525', '580'], 'mid_img' => 'fonts/he.png'],
        '62-56' => ['left_top' => ['491', '554'], 'img' => 'six_he/62-56.png', 'middle' => ['526', '647'], 'mid_img' => 'fonts/he.png'],

    ];


    /**
     * It gets the six he relations of the ben gua, the ben gua and the trans gua, the day gua and the
     * ben gua, the day gua and the trans gua, the month gua and the ben gua, and the month gua and the
     * trans gua
     */
    public function handleRelationSixHe()
    {
        $benGuaSixHeSelf = $this->getSixHeByBenGua();

        $benGuaHeTrans = $this->getSixHeBenAndTrans();

        $dayHeBenGua = $this->getSixHeDay2Ben();

        $dayHeTransGua = $this->getSixHeDay2Trans();

        $monthHeBenGua = $this->getSixHeMonth2Ben();

        $monthHeTransGua = $this->getSixHeMonth2Trans();

        $this->draw['six_he'] = array_merge($benGuaSixHeSelf, $benGuaHeTrans, $dayHeBenGua,
            $dayHeTransGua, $monthHeBenGua, $monthHeTransGua);

        return $this;
    }

    /**
     * It returns the six he relations of the ben gua
     */
    public function getSixHeByBenGua()
    {
        $dongs = $this->getBenDong();

        $he = [];

        $count = count($dongs);

        if ($count > 1) {
            foreach ($dongs as $key => $dong) {
                if ($dong['is_an_dong']) {
                    continue;
                }

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
     * > If the array of arrays `->sixHe` contains either `[, ]` or `[, ]`, then return
     * `true`
     *
     * @param a The first person's name
     * @param b the number of the current player
     */
    public function isHeRelation($a, $b)
    {
        return in_array([$a, $b], $this->sixHe) || in_array([$b, $a], $this->sixHe);
    }

    /**
     * It returns an array of strings, each string is a pair of numbers, the first number is the
     * position of the ben gua, the second number is the position of the trans gua
     */
    public function getSixHeBenAndTrans()
    {
        if ($this->transGuaExists()) {
            $he = [];
            $ben_arr = $this->diZhi2Arr($this->resultDiZhi['di_zhi']);
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

    /**
     * > Get the six-he relation of the day-master with the ben-dong
     */
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

    /**
     * It returns an array of the six he of the day.
     */
    public function getSixHeDay2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getHeByDate($this->diZhiDay, $trans_arr, '62', '5');
        }
        return [];
    }

    /**
     * It returns the position of the date in the array.
     *
     * @param date_di_zhi the date of the day
     * @param di_zhi_arr the array of the 12 zodiac signs
     * @param start the start position of the date, such as A1
     * @param column the column of the date, such as 'A'
     */
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

    /**
     * > Get the six he relation of the month branch with the ben dong
     */
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

    /**
     * It returns the six he month 2 trans.
     */
    public function getSixHeMonth2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getHeByDate($this->diZhiMonth, $trans_arr, '61', '5');
        }
        return [];
    }


}
