<?php


namespace Maturest\Trigram\Traits;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait SixCongTrait
{
    //六冲
    protected $sixCong = [
        ['子', '午'],
        ['丑', '未'],
        ['寅', '申'],
        ['卯', '酉'],
        ['辰', '戌'],
        ['巳', '亥'],
    ];

    // 先按类别，然后再按论关系的纬度
    protected $sixCongImages = [
        //本爻与本爻
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
        //本爻与化爻
        '41-51' => ['left_top' => ['392', '146'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '130'], 'font' => '冲'],
        '42-52' => ['left_top' => ['392', '268'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '252'], 'font' => '冲'],
        '43-53' => ['left_top' => ['392', '391'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '375'], 'font' => '冲'],
        '44-54' => ['left_top' => ['392', '513'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '497'], 'font' => '冲'],
        '45-55' => ['left_top' => ['392', '636'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '620'], 'font' => '冲'],
        '46-56' => ['left_top' => ['392', '758'], 'img' => 'six_chong/41-51.png', 'middle' => ['405', '742'], 'font' => '冲'],
        //本爻与月令
        '61-41' => ['left_top' => ['387', '171'], 'img' => 'six_chong/61-41.png', 'middle' => ['485', '193'], 'mid_img' => 'fonts/po.png'],
        '61-42' => ['left_top' => ['374', '232'], 'img' => 'six_chong/61-42.png', 'middle' => ['485', '224'], 'mid_img' => 'fonts/po.png'],
        '61-43' => ['left_top' => ['385', '245'], 'img' => 'six_chong/61-43.png', 'middle' => ['484', '290'], 'mid_img' => 'fonts/po.png'],
        '61-44' => ['left_top' => ['380', '270'], 'img' => 'six_chong/61-44.png', 'middle' => ['487', '404'], 'mid_img' => 'fonts/po.png'],
        '61-45' => ['left_top' => ['383', '293'], 'img' => 'six_chong/61-45.png', 'middle' => ['484', '516'], 'mid_img' => 'fonts/po.png'],
        '61-46' => ['left_top' => ['379', '315'], 'img' => 'six_chong/61-46.png', 'middle' => ['496', '611'], 'mid_img' => 'fonts/po.png'],
        //本爻与日令
        '62-41' => ['left_top' => ['384', '166'], 'img' => 'six_chong/62-41.png', 'middle' => ['499', '284'], 'mid_img' => 'fonts/chong.png'],
        '62-42' => ['left_top' => ['384', '294'], 'img' => 'six_chong/62-42.png', 'middle' => ['495', '401'], 'mid_img' => 'fonts/chong.png'],
        '62-43' => ['left_top' => ['386', '420'], 'img' => 'six_chong/62-43.png', 'middle' => ['495', '458'], 'mid_img' => 'fonts/chong.png'],
        '62-44' => ['left_top' => ['388', '538'], 'img' => 'six_chong/62-44.png', 'middle' => ['486', '545'], 'mid_img' => 'fonts/chong.png'],
        '62-45' => ['left_top' => ['380', '554'], 'img' => 'six_chong/62-45.png', 'middle' => ['462', '576'], 'mid_img' => 'fonts/chong.png'],
        '62-46' => ['left_top' => ['381', '566'], 'img' => 'six_chong/62-46.png', 'middle' => ['482', '650'], 'mid_img' => 'fonts/chong.png'],
        //化爻与月令
        '61-51' => ['left_top' => ['491', '158'], 'img' => 'six_chong/61-51.png', 'middle' => ['526', '178'], 'mid_img' => 'fonts/po.png'],
        '61-52' => ['left_top' => ['488', '236'], 'img' => 'six_chong/61-52.png', 'middle' => ['525', '246'], 'mid_img' => 'fonts/po.png'],
        '61-53' => ['left_top' => ['483', '250'], 'img' => 'six_chong/61-53.png', 'middle' => ['516', '315'], 'mid_img' => 'fonts/po.png'],
        '61-54' => ['left_top' => ['484', '271'], 'img' => 'six_chong/61-54.png', 'middle' => ['519', '393'], 'mid_img' => 'fonts/po.png'],
        '61-55' => ['left_top' => ['481', '293'], 'img' => 'six_chong/61-55.png', 'middle' => ['520', '464'], 'mid_img' => 'fonts/po.png'],
        '61-56' => ['left_top' => ['482', '307'], 'img' => 'six_chong/61-56.png', 'middle' => ['524', '536'], 'mid_img' => 'fonts/po.png'],
        //化爻与日令
        '62-51' => ['left_top' => ['481', '156'], 'img' => 'six_chong/62-51.png', 'middle' => ['529', '310'], 'mid_img' => 'fonts/chong.png'],
        '62-52' => ['left_top' => ['480', '280'], 'img' => 'six_chong/62-52.png', 'middle' => ['524', '376'], 'mid_img' => 'fonts/chong.png'],
        '62-53' => ['left_top' => ['485', '403'], 'img' => 'six_chong/62-53.png', 'middle' => ['523', '444'], 'mid_img' => 'fonts/chong.png'],
        '62-54' => ['left_top' => ['483', '525'], 'img' => 'six_chong/62-54.png', 'middle' => ['521', '520'], 'mid_img' => 'fonts/chong.png'],
        '62-55' => ['left_top' => ['485', '539'], 'img' => 'six_chong/62-55.png', 'middle' => ['525', '580'], 'mid_img' => 'fonts/chong.png'],
        '62-56' => ['left_top' => ['488', '555'], 'img' => 'six_chong/62-56.png', 'middle' => ['526', '647'], 'mid_img' => 'fonts/chong.png'],

    ];

    /**
     * 处理六冲关系
     * @return $this
     */
    public function handleRelationSixCong()
    {
        // 纯静爻有暗动  动爻也有暗动
        //$this->getYaoDetail();

        // 1、本爻与本爻
        $benGuaCongSelf = $this->getSixCongByBenGua();

        // 2、本爻与自己的化爻
        $benGuaCongTrans = $this->getSixCongBenAndTrans();

        // 3、日令与本爻
        $dayCongBenGua = $this->getSixCongDay2Ben();

        // 4、日令与化爻
        $dayCongTransGua = $this->getSixCongDay2Trans();

        // 5、月令与本爻
        $monthCongBenGua = $this->getSixCongMonth2Ben();

        // 6、月令与化爻
        $monthCongTransGua = $this->getSixCongMonth2Trans();

        $this->draw['six_chong'] = array_merge($benGuaCongSelf, $benGuaCongTrans, $dayCongBenGua,
            $dayCongTransGua, $monthCongBenGua, $monthCongTransGua);

        return $this;
    }

    /**
     * 本爻中六冲关系，只论动摇与动摇之间的关系
     * @return array
     */
    public function getSixCongByBenGua()
    {
        // 取出本卦中所有动爻

        $dongs = $this->getBenDong();

        $cong = [];

        $count = count($dongs);

        if ($count > 1) {
            foreach ($dongs as $key => $dong) {
                // 每从地支里拿出来一个，就要与对应的比
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
     * 判断两个是否存在六冲关系
     * @param $a
     * @param $b
     * @return bool
     */
    public function isCongRelation($a, $b)
    {
        return in_array([$a, $b], $this->sixCong) || in_array([$b, $a], $this->sixCong);
    }

    public function getSixCongBenAndTrans()
    {
        // 如果存在化爻
        if ($this->transGuaExists()) {
            $cong = [];
            // 本卦地支数组
            $ben_arr = $this->diZhi2Arr($this->resultDiZhi['di_zhi']);
            // 化爻地支数组
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
     * 日令与静爻的六冲关系为 暗动，日令与本卦中的动爻
     * @return array
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
     * 日令与化爻的六冲
     * @return array
     */
    public function getSixCongDay2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getCongByDate($this->diZhiDay, $trans_arr, '62', '5');
        }
        return [];
    }

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
     * 月令与本卦的六冲关系
     * @return array
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
     * 月令与化爻之间的六冲关系
     * @return array
     */
    public function getSixCongMonth2Trans()
    {
        if ($this->transGuaExists()) {
            $trans_arr = $this->diZhi2Arr($this->resultDiZhi['trans_di_zhi']);
            return $this->getCongByDate($this->diZhiMonth, $trans_arr, '61', '5');
        }
        return [];
    }

    public function getCong($di_zhi)
    {
        $row = Arr::first($this->sixCong, function ($item, $key) use ($di_zhi) {
            return in_array($di_zhi, $item);
        });

        return Str::replaceFirst($di_zhi, '', implode('', $row));
    }
}
