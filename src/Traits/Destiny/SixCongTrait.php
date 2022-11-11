<?php


namespace Maturest\Trigram\Traits\Destiny;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait SixCongTrait
{
    protected $sixCong = [
        ['子', '午'],
        ['丑', '未'],
        ['寅', '申'],
        ['卯', '酉'],
        ['辰', '戌'],
        ['巳', '亥'],
    ];

    protected $sixCongImages = [

        '41-42' => ['left_top' => ['148', '155'], 'img' => 'six_chong/11-12.png', 'middle' => ['138', '204'], 'mid_img' => 'fonts/chong.png'],
        '41-43' => ['left_top' => ['121', '153'], 'img' => 'six_chong/11-13.png', 'middle' => ['112', '255'], 'mid_img' => 'fonts/chong.png'],
        '41-44' => ['left_top' => ['94', '153'], 'img' => 'six_chong/11-14.png', 'middle' => ['86', '322'], 'mid_img' => 'fonts/chong.png'],
        '41-45' => ['left_top' => ['68', '152'], 'img' => 'six_chong/11-15.png', 'middle' => ['72', '396'], 'mid_img' => 'fonts/chong.png'],
        '41-46' => ['left_top' => ['53', '151'], 'img' => 'six_chong/11-16.png', 'middle' => ['43', '454'], 'mid_img' => 'fonts/chong.png'],
        '42-43' => ['left_top' => ['148', '277'], 'img' => 'six_chong/12-13.png', 'middle' => ['138', '327'], 'mid_img' => 'fonts/chong.png'],
        '42-44' => ['left_top' => ['120', '278'], 'img' => 'six_chong/12-14.png', 'middle' => ['111', '384'], 'mid_img' => 'fonts/chong.png'],
        '42-45' => ['left_top' => ['97', '277'], 'img' => 'six_chong/12-15.png', 'middle' => ['89', '460'], 'mid_img' => 'fonts/chong.png'],
        '42-46' => ['left_top' => ['81', '275'], 'img' => 'six_chong/12-16.png', 'middle' => ['72', '495'], 'mid_img' => 'fonts/chong.png'],
        '43-44' => ['left_top' => ['148', '407'], 'img' => 'six_chong/13-14.png', 'middle' => ['138', '457'], 'mid_img' => 'fonts/chong.png'],
        '43-45' => ['left_top' => ['115', '407'], 'img' => 'six_chong/13-15.png', 'middle' => ['106', '516'], 'mid_img' => 'fonts/chong.png'],
        '43-46' => ['left_top' => ['82', '407'], 'img' => 'six_chong/13-16.png', 'middle' => ['74', '584'], 'mid_img' => 'fonts/chong.png'],
        '44-45' => ['left_top' => ['148', '530'], 'img' => 'six_chong/14-15.png', 'middle' => ['138', '580'], 'mid_img' => 'fonts/chong.png'],
        '44-46' => ['left_top' => ['115', '530'], 'img' => 'six_chong/14-16.png', 'middle' => ['106', '639'], 'mid_img' => 'fonts/chong.png'],
        '45-46' => ['left_top' => ['148', '652'], 'img' => 'six_chong/15-16.png', 'middle' => ['138', '701'], 'mid_img' => 'fonts/chong.png'],

        '41-51' => ['left_top' => ['392', '146'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '130'], 'font' => '冲'],
        '42-52' => ['left_top' => ['392', '268'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '252'], 'font' => '冲'],
        '43-53' => ['left_top' => ['392', '391'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '375'], 'font' => '冲'],
        '44-54' => ['left_top' => ['392', '513'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '497'], 'font' => '冲'],
        '45-55' => ['left_top' => ['392', '636'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '620'], 'font' => '冲'],
        '46-56' => ['left_top' => ['392', '758'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '742'], 'font' => '冲'],

        '61-41' => ['left_top' => ['387', '171'], 'img' => 'six_chong/61-41.png', 'middle' => ['485', '193'], 'mid_img' => 'fonts/po.png'],
        '61-42' => ['left_top' => ['374', '232'], 'img' => 'six_chong/61-42.png', 'middle' => ['485', '224'], 'mid_img' => 'fonts/po.png'],
        '61-43' => ['left_top' => ['385', '245'], 'img' => 'six_chong/61-43.png', 'middle' => ['484', '290'], 'mid_img' => 'fonts/po.png'],
        '61-44' => ['left_top' => ['380', '270'], 'img' => 'six_chong/61-44.png', 'middle' => ['487', '404'], 'mid_img' => 'fonts/po.png'],
        '61-45' => ['left_top' => ['383', '293'], 'img' => 'six_chong/61-45.png', 'middle' => ['484', '516'], 'mid_img' => 'fonts/po.png'],
        '61-46' => ['left_top' => ['379', '315'], 'img' => 'six_chong/61-46.png', 'middle' => ['496', '611'], 'mid_img' => 'fonts/po.png'],

        '62-41' => ['left_top' => ['384', '166'], 'img' => 'six_chong/62-41.png', 'middle' => ['499', '284'], 'mid_img' => 'fonts/chong.png'],
        '62-42' => ['left_top' => ['384', '294'], 'img' => 'six_chong/62-42.png', 'middle' => ['495', '401'], 'mid_img' => 'fonts/chong.png'],
        '62-43' => ['left_top' => ['386', '420'], 'img' => 'six_chong/62-43.png', 'middle' => ['495', '458'], 'mid_img' => 'fonts/chong.png'],
        '62-44' => ['left_top' => ['388', '538'], 'img' => 'six_chong/62-44.png', 'middle' => ['486', '545'], 'mid_img' => 'fonts/chong.png'],
        '62-45' => ['left_top' => ['380', '554'], 'img' => 'six_chong/62-45.png', 'middle' => ['462', '576'], 'mid_img' => 'fonts/chong.png'],
        '62-46' => ['left_top' => ['381', '566'], 'img' => 'six_chong/62-46.png', 'middle' => ['482', '650'], 'mid_img' => 'fonts/chong.png'],

        '61-51' => ['left_top' => ['491', '158'], 'img' => 'six_chong/61-51.png', 'middle' => ['526', '178'], 'mid_img' => 'fonts/po.png'],
        '61-52' => ['left_top' => ['488', '236'], 'img' => 'six_chong/61-52.png', 'middle' => ['525', '246'], 'mid_img' => 'fonts/po.png'],
        '61-53' => ['left_top' => ['483', '250'], 'img' => 'six_chong/61-53.png', 'middle' => ['516', '315'], 'mid_img' => 'fonts/po.png'],
        '61-54' => ['left_top' => ['484', '271'], 'img' => 'six_chong/61-54.png', 'middle' => ['519', '393'], 'mid_img' => 'fonts/po.png'],
        '61-55' => ['left_top' => ['481', '293'], 'img' => 'six_chong/61-55.png', 'middle' => ['520', '464'], 'mid_img' => 'fonts/po.png'],
        '61-56' => ['left_top' => ['482', '307'], 'img' => 'six_chong/61-56.png', 'middle' => ['524', '536'], 'mid_img' => 'fonts/po.png'],

        '62-51' => ['left_top' => ['481', '156'], 'img' => 'six_chong/62-51.png', 'middle' => ['529', '310'], 'mid_img' => 'fonts/chong.png'],
        '62-52' => ['left_top' => ['480', '280'], 'img' => 'six_chong/62-52.png', 'middle' => ['524', '376'], 'mid_img' => 'fonts/chong.png'],
        '62-53' => ['left_top' => ['485', '403'], 'img' => 'six_chong/62-53.png', 'middle' => ['523', '444'], 'mid_img' => 'fonts/chong.png'],
        '62-54' => ['left_top' => ['483', '525'], 'img' => 'six_chong/62-54.png', 'middle' => ['521', '520'], 'mid_img' => 'fonts/chong.png'],
        '62-55' => ['left_top' => ['485', '539'], 'img' => 'six_chong/62-55.png', 'middle' => ['525', '580'], 'mid_img' => 'fonts/chong.png'],
        '62-56' => ['left_top' => ['488', '555'], 'img' => 'six_chong/62-56.png', 'middle' => ['526', '647'], 'mid_img' => 'fonts/chong.png'],

    ];


    /**
     * It gets the six cong of the ben gua, the ben gua and the trans gua, the day gua and the ben gua,
     * the day gua and the trans gua, the month gua and the ben gua, and the month gua and the trans
     * gua
     */
    public function handleRelationSixCong()
    {

        $benGuaCongSelf = $this->getSixCongByBenGua();

        $benGuaCongTrans = $this->getSixCongBenAndTrans();

        $dayCongBenGua = $this->getSixCongDay2Ben();

        $dayCongTransGua = $this->getSixCongDay2Trans();

        $monthCongBenGua = $this->getSixCongMonth2Ben();

        $monthCongTransGua = $this->getSixCongMonth2Trans();

        $this->draw['six_chong'] = array_merge($benGuaCongSelf, $benGuaCongTrans, $dayCongBenGua,
            $dayCongTransGua, $monthCongBenGua, $monthCongTransGua);

        return $this;
    }


    /**
     * It returns the six cong relations of the ben gua.
     */
    public function getSixCongByBenGua()
    {
        $dongs = $this->getBenDong();

        $cong = [];

        $count = count($dongs);

        if ($count > 1) {
            foreach ($dongs as $key => $dong) {
                $start = $key + 1;
                for ($i = $start; $i < $count; $i++) {
                    if ($this->isCongRelation($dong['dz'], $dongs[$i]['dz'])) {
                        $cong[] = $dong['column'] . $dong['row'] . '-' . $dongs[$i]['column'] . $dongs[$i]['row'];
                    }
                }
            }
        }

        return $cong;
    }


    /**
     * > Given two numbers, return true if they are congruent modulo 6
     *
     * @param a the first number
     * @param b the number of the first note
     */
    public function isCongRelation($a, $b)
    {
        return in_array([$a, $b], $this->sixCong) || in_array([$b, $a], $this->sixCong);
    }

    /**
     * It returns an array of strings, each string is a pair of numbers, the first number is the
     * position of the ben gua, the second number is the position of the trans gua
     */
    public function getSixCongBenAndTrans()
    {

        if ($this->transGuaExists()) {
            $cong = [];

            $ben_arr = $this->diZhi2Arr($this->resultDiZhi['di_zhi']);
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);

            foreach ($ben_arr as $key => $val) {
                if ($this->isCongRelation($val, $trans_arr[$key])) {
                    $position = $key + 1;
                    $cong[] = '4' . $position . '-' . '5' . $position;
                }
            }
            return $cong;
        }
        return [];
    }


   /**
    * It returns the six cong of the day pillar.
    */
    public function getSixCongDay2Ben()
    {
        $dongs = $this->getBenPureDong();
        $cong = [];
        foreach ($dongs as $dong) {
            if ($this->isCongRelation($this->diZhiDay, $dong['dz'])) {
                $cong[] = '62-' . $dong['column'] . $dong['row'];
            }
        }
        return $cong;
    }


   /**
    * It returns the 6th cong of the day.
    */
    public function getSixCongDay2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getCongByDate($this->diZhiDay, $trans_arr, '62', '5');
        }
        return [];
    }

    /**
     * It takes a date, a list of dates, a start column, and a column, and returns a list of cells that
     * are in conflict with the date
     *
     * @param date_di_zhi the date's stem
     * @param di_zhi_arr the array of the 12 zodiacs
     * @param start the start column of the table
     * @param column the column of the date
     */
    public function getCongByDate($date_di_zhi, $di_zhi_arr, $start, $column)
    {
        $cong = [];
        foreach ($di_zhi_arr as $key => $value) {
            if ($this->isCongRelation($value, $date_di_zhi)) {
                $position = $key + 1;
                $cong[] = $start . '-' . $column . $position;
            }
        }
        return $cong;
    }


    /**
     * It returns the six cong of the month.
     */
    public function getSixCongMonth2Ben()
    {
        $dongs = $this->getBenDong();
        $cong = [];
        foreach ($dongs as $dong) {
            if ($this->isCongRelation($this->diZhiMonth, $dong['dz'])) {
                $cong[] = '61-' . $dong['column'] . $dong['row'];
            }
        }
        return $cong;
    }


    /**
     * It returns the 6th month of the year, which is June.
     */
    public function getSixCongMonth2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getCongByDate($this->diZhiMonth, $trans_arr, '61', '5');
        }
        return [];
    }

    /**
     * > It takes a string of a single character and returns a string of the remaining five characters
     * of the same row in the six-row array
     *
     * @param di_zhi The address of the hexagram
     *
     * @return the cong of the given di_zhi.
     */
    public function getCong($di_zhi)
    {
        $row = Arr::first($this->sixCong, function ($item, $key) use ($di_zhi) {
            return in_array($di_zhi, $item);
        });

        return Str::replaceFirst($di_zhi, '', implode('', $row));
    }
}
