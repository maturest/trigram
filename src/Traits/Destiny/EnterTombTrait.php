<?php


namespace Maturest\Trigram\Traits\Destiny;


use Illuminate\Support\Arr;

trait EnterTombTrait
{

    protected $ruMuImages = [
        //本爻与本爻
        '41-42' => ['left_top' => ['148', '155'], 'img' => 'enter_tomb/11-12.png', 'middle' => ['138', '204'], 'mid_img' => 'fonts/ru.png'],
        '41-43' => ['left_top' => ['121', '153'], 'img' => 'enter_tomb/11-13.png', 'middle' => ['112', '255'], 'mid_img' => 'fonts/ru.png'],
        '41-44' => ['left_top' => ['94', '153'], 'img' => 'enter_tomb/11-14.png', 'middle' => ['86', '322'], 'mid_img' => 'fonts/ru.png'],
        '41-45' => ['left_top' => ['68', '152'], 'img' => 'enter_tomb/11-15.png', 'middle' => ['72', '396'], 'mid_img' => 'fonts/ru.png'],
        '41-46' => ['left_top' => ['53', '151'], 'img' => 'enter_tomb/11-16.png', 'middle' => ['43', '454'], 'mid_img' => 'fonts/ru.png'],
        '42-43' => ['left_top' => ['148', '277'], 'img' => 'enter_tomb/12-13.png', 'middle' => ['138', '327'], 'mid_img' => 'fonts/ru.png'],
        '42-44' => ['left_top' => ['120', '278'], 'img' => 'enter_tomb/12-14.png', 'middle' => ['111', '384'], 'mid_img' => 'fonts/ru.png'],
        '42-45' => ['left_top' => ['97', '277'], 'img' => 'enter_tomb/12-15.png', 'middle' => ['89', '460'], 'mid_img' => 'fonts/ru.png'],
        '42-46' => ['left_top' => ['81', '275'], 'img' => 'enter_tomb/12-16.png', 'middle' => ['72', '495'], 'mid_img' => 'fonts/ru.png'],
        '43-44' => ['left_top' => ['148', '407'], 'img' => 'enter_tomb/13-14.png', 'middle' => ['138', '457'], 'mid_img' => 'fonts/ru.png'],
        '43-45' => ['left_top' => ['115', '407'], 'img' => 'enter_tomb/13-15.png', 'middle' => ['106', '516'], 'mid_img' => 'fonts/ru.png'],
        '43-46' => ['left_top' => ['82', '407'], 'img' => 'enter_tomb/13-16.png', 'middle' => ['74', '584'], 'mid_img' => 'fonts/ru.png'],
        '44-45' => ['left_top' => ['148', '530'], 'img' => 'enter_tomb/14-15.png', 'middle' => ['138', '580'], 'mid_img' => 'fonts/ru.png'],
        '44-46' => ['left_top' => ['115', '530'], 'img' => 'enter_tomb/14-16.png', 'middle' => ['106', '639'], 'mid_img' => 'fonts/ru.png'],
        '45-46' => ['left_top' => ['148', '652'], 'img' => 'enter_tomb/15-16.png', 'middle' => ['138', '701'], 'mid_img' => 'fonts/ru.png'],
        //本爻与化爻
        '41-51' => ['left_top' => ['397', '146'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '130'], 'font' => '入'],
        '42-52' => ['left_top' => ['397', '268'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '252'], 'font' => '入'],
        '43-53' => ['left_top' => ['397', '391'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '375'], 'font' => '入'],
        '44-54' => ['left_top' => ['397', '513'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '497'], 'font' => '入'],
        '45-55' => ['left_top' => ['397', '636'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '620'], 'font' => '入'],
        '46-56' => ['left_top' => ['397', '758'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '742'], 'font' => '入'],
        //本爻与月令
        '41-61' => ['left_top' => ['383', '173'], 'img' => 'enter_tomb/61-41.png', 'middle' => ['485', '192'], 'mid_img' => 'fonts/ru.png'],
        '42-61' => ['left_top' => ['378', '230'], 'img' => 'enter_tomb/61-42.png', 'middle' => ['464', '224'], 'mid_img' => 'fonts/ru.png'],
        '43-61' => ['left_top' => ['387', '244'], 'img' => 'enter_tomb/61-43.png', 'middle' => ['488', '286'], 'mid_img' => 'fonts/ru.png'],
        '44-61' => ['left_top' => ['383', '269'], 'img' => 'enter_tomb/61-44.png', 'middle' => ['484', '408'], 'mid_img' => 'fonts/ru.png'],
        '45-61' => ['left_top' => ['384', '291'], 'img' => 'enter_tomb/61-45.png', 'middle' => ['488', '508'], 'mid_img' => 'fonts/ru.png'],
        '46-61' => ['left_top' => ['382', '314'], 'img' => 'enter_tomb/61-46.png', 'middle' => ['507', '588'], 'mid_img' => 'fonts/ru.png'],
        //本爻与日令
        '41-62' => ['left_top' => ['385', '168'], 'img' => 'enter_tomb/62-41.png', 'middle' => ['498', '293'], 'mid_img' => 'fonts/ru.png'],
        '42-62' => ['left_top' => ['386', '296'], 'img' => 'enter_tomb/62-42.png', 'middle' => ['495', '401'], 'mid_img' => 'fonts/ru.png'],
        '43-62' => ['left_top' => ['388', '422'], 'img' => 'enter_tomb/62-43.png', 'middle' => ['496', '460'], 'mid_img' => 'fonts/ru.png'],
        '44-62' => ['left_top' => ['390', '537'], 'img' => 'enter_tomb/62-44.png', 'middle' => ['486', '545'], 'mid_img' => 'fonts/ru.png'],
        '45-62' => ['left_top' => ['381', '553'], 'img' => 'enter_tomb/62-45.png', 'middle' => ['463', '576'], 'mid_img' => 'fonts/ru.png'],
        '46-62' => ['left_top' => ['382', '565'], 'img' => 'enter_tomb/62-46.png', 'middle' => ['483', '651'], 'mid_img' => 'fonts/ru.png'],
        //化爻与月令
        '51-61' => ['left_top' => ['491', '159'], 'img' => 'enter_tomb/61-51.png', 'middle' => ['526', '178'], 'mid_img' => 'fonts/ru.png'],
        '52-61' => ['left_top' => ['489', '233'], 'img' => 'enter_tomb/61-52.png', 'middle' => ['525', '246'], 'mid_img' => 'fonts/ru.png'],
        '53-61' => ['left_top' => ['485', '249'], 'img' => 'enter_tomb/61-53.png', 'middle' => ['516', '315'], 'mid_img' => 'fonts/ru.png'],
        '54-61' => ['left_top' => ['484', '271'], 'img' => 'enter_tomb/61-54.png', 'middle' => ['519', '393'], 'mid_img' => 'fonts/ru.png'],
        '55-61' => ['left_top' => ['482', '293'], 'img' => 'enter_tomb/61-55.png', 'middle' => ['520', '464'], 'mid_img' => 'fonts/ru.png'],
        '56-61' => ['left_top' => ['482', '311'], 'img' => 'enter_tomb/61-56.png', 'middle' => ['525', '536'], 'mid_img' => 'fonts/ru.png'],
        //化爻与日令
        '51-62' => ['left_top' => ['482', '158'], 'img' => 'enter_tomb/62-51.png', 'middle' => ['529', '310'], 'mid_img' => 'fonts/ru.png'],
        '52-62' => ['left_top' => ['482', '283'], 'img' => 'enter_tomb/62-52.png', 'middle' => ['524', '376'], 'mid_img' => 'fonts/ru.png'],
        '53-62' => ['left_top' => ['485', '404'], 'img' => 'enter_tomb/62-53.png', 'middle' => ['523', '444'], 'mid_img' => 'fonts/ru.png'],
        '54-62' => ['left_top' => ['485', '522'], 'img' => 'enter_tomb/62-54.png', 'middle' => ['521', '520'], 'mid_img' => 'fonts/ru.png'],
        '55-62' => ['left_top' => ['489', '537'], 'img' => 'enter_tomb/62-55.png', 'middle' => ['525', '580'], 'mid_img' => 'fonts/ru.png'],
        '56-62' => ['left_top' => ['491', '554'], 'img' => 'enter_tomb/62-56.png', 'middle' => ['526', '647'], 'mid_img' => 'fonts/ru.png'],
        //本爻与本爻之间的入墓关系 从下到上
        '42-41' => ['left_top' => ['148', '155'], 'img' => 'enter_tomb/12-11.png', 'middle' => ['138', '204'], 'mid_img' => 'fonts/ru.png'],
        '43-41' => ['left_top' => ['121', '153'], 'img' => 'enter_tomb/13-11.png', 'middle' => ['112', '255'], 'mid_img' => 'fonts/ru.png'],
        '44-41' => ['left_top' => ['94', '153'], 'img' => 'enter_tomb/14-11.png', 'middle' => ['86', '322'], 'mid_img' => 'fonts/ru.png'],
        '45-41' => ['left_top' => ['81', '153'], 'img' => 'enter_tomb/15-11.png', 'middle' => ['72', '396'], 'mid_img' => 'fonts/ru.png'],
        '46-41' => ['left_top' => ['53', '153'], 'img' => 'enter_tomb/16-11.png', 'middle' => ['43', '454'], 'mid_img' => 'fonts/ru.png'],
        '43-42' => ['left_top' => ['148', '279'], 'img' => 'enter_tomb/13-12.png', 'middle' => ['138', '327'], 'mid_img' => 'fonts/ru.png'],
        '44-42' => ['left_top' => ['120', '278'], 'img' => 'enter_tomb/14-12.png', 'middle' => ['112', '384'], 'mid_img' => 'fonts/ru.png'],
        '45-42' => ['left_top' => ['97', '277'], 'img' => 'enter_tomb/15-12.png', 'middle' => ['89', '460'], 'mid_img' => 'fonts/ru.png'],
        '46-42' => ['left_top' => ['81', '277'], 'img' => 'enter_tomb/16-12.png', 'middle' => ['72', '495'], 'mid_img' => 'fonts/ru.png'],
        '44-43' => ['left_top' => ['148', '407'], 'img' => 'enter_tomb/14-13.png', 'middle' => ['138', '457'], 'mid_img' => 'fonts/ru.png'],
        '45-43' => ['left_top' => ['115', '407'], 'img' => 'enter_tomb/15-13.png', 'middle' => ['107', '517'], 'mid_img' => 'fonts/ru.png'],
        '46-43' => ['left_top' => ['82', '407'], 'img' => 'enter_tomb/16-13.png', 'middle' => ['74', '584'], 'mid_img' => 'fonts/ru.png'],
        '45-44' => ['left_top' => ['148', '530'], 'img' => 'enter_tomb/15-14.png', 'middle' => ['138', '580'], 'mid_img' => 'fonts/ru.png'],
        '46-44' => ['left_top' => ['115', '530'], 'img' => 'enter_tomb/16-14.png', 'middle' => ['106', '639'], 'mid_img' => 'fonts/ru.png'],
        '46-45' => ['left_top' => ['148', '652'], 'img' => 'enter_tomb/16-15.png', 'middle' => ['138', '701'], 'mid_img' => 'fonts/ru.png'],

    ];

    // 入墓
    protected $ruMu = [
        ['ru_mu' => ['巳', '午'], 'ru' => '戌', 'jx' => '午'],
        ['ru_mu' => ['寅', '卯'], 'ru' => '未', 'jx' => '卯'],
        ['ru_mu' => ['子', '亥'], 'ru' => '辰', 'jx' => '亥'],
        ['ru_mu' => ['申', '酉'], 'ru' => '丑', 'jx' => '酉'],
    ];

    /**
     * 入墓关系
     * @return $this
     */
    public function handleEnterTomb()
    {
        //取出本爻的动爻
        $ben_positions = $this->getAllBenPositions();
        //获取所有汇局的将星
        $jxs = $this->getAllJX();
        //找出墓库，然后将墓库作为终点，循环遍历找起点
        $mu_kus = collect($this->ruMu)->pluck('ru')->toArray();

        //1、本爻与本爻
        $ben_tomb = $this->getEnterTombByB2B($ben_positions, $jxs, $mu_kus);
        //取出所有的化爻
        $trans = $this->getAllHuaPositions();
        //2、本爻与自己的化爻
        $ben_trans_tomb = $this->getEnterTombBen2Trans($ben_positions, $trans, $jxs, $mu_kus);
        //3、日令与本爻
        $day_ben_tomb = $this->getEnterTombBenDay($ben_positions, $jxs, $mu_kus);

        //4、日令与化爻
        $day_trans = $this->getEnterTombTransDay($trans, $jxs, $mu_kus);

        //5、月令与本爻
        $month_ben = $this->getEnterTombBenMonth($ben_positions, $jxs, $mu_kus);

        //6、月令与化爻
        $month_hua_tomb = $this->getEnterTombTransMonth($trans, $jxs, $mu_kus);

        $res = array_merge($ben_tomb, $ben_trans_tomb, $day_ben_tomb,
            $day_trans, $month_ben, $month_hua_tomb);

        $this->draw['ru_mu'] = collect($res)->unique()->toArray();

        return $this;
    }

    public function getAllBenPositions()
    {
        return $this->getBenDong();
    }

    /**
     * 获取本卦中的动爻
     */
    public function getBenDong()
    {
        $dongs = array_values(Arr::where($this->benGuaDetail, function ($item, $key){
            return $item['is_dong'] || $item['is_an_dong'];
        }));

        $dongs = array_reverse($dongs);

        return $dongs;
    }

    /**
     * 取出所有的将星
     * @return array
     */
    public function getAllJX()
    {
        $jx = [];
        if ($this->isJxExists()) {
            $hui_ju = $this->draw['hui_ju'];
            foreach ($hui_ju as $val) {
                $hui_jx = collect($val)->pluck('jx_position')->toArray();
                $jx = array_merge($jx, $hui_jx);
            }
        }
        return $jx;
    }

    /**
     * 判断将星是否存在
     * @return bool
     */
    public function isJxExists()
    {
        return isset($this->draw['hui_ju']) && $this->draw['hui_ju'];
    }

    /**
     * 获取本爻与本爻之间的入墓关系
     * @return array
     */
    public function getEnterTombByB2B($positions, $jxs, $mu_kus)
    {
        if (empty($positions)) {
            return [];
        }

        return $this->getEnterTombWithTwoPoints($positions, $positions, $jxs, $mu_kus);
    }

    /**
     * 获取两点的入墓关系
     * @param $one
     * @param $two
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombWithTwoPoints($one, $two, $jxs, $mu_kus)
    {
        $tombs_start_with_one = $this->getEnterTombRelation($one, $two, $jxs, $mu_kus);

        $tombs_start_with_two = $this->getEnterTombRelation($two, $one, $jxs, $mu_kus);

        return array_merge($tombs_start_with_one, $tombs_start_with_two);
    }

    /**
     * 获取起始位置的入墓关系
     * @param $start_positions
     * @param $end_positions
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombRelation($start_positions, $end_positions, $jxs, $mu_kus)
    {
        $res = [];
        foreach ($end_positions as $end_position) {
            $end_dz = $end_position['dz'];
            //判断终点是不是墓库
            if (in_array($end_dz, $mu_kus)) {
                $row = collect($this->ruMu)->where('ru', $end_dz)->first();

                foreach ($start_positions as $start_position) {
                    //判断起点是不是暗动，如果是暗动就不需要入墓
                    if (isset($start_position['is_an_dong']) && $start_position['is_an_dong']) {
                        continue;
                    }

                    //判断起点的地支是不是需要入墓
                    if (in_array($start_position['dz'], $row['ru_mu']) && !in_array($start_position['column'].$start_position['row'], $jxs)) {
                        $terminal_point = $end_position['column'] . $end_position['row'];
                        $start_point = $start_position['column'] . $start_position['row'];
                        $res[] = $start_point . '-' . $terminal_point;
                    }
                }
            }
        }
        return $res;
    }

    public function getAllHuaPositions()
    {
        $res = [];
        if ($this->transGuaExists()) {
            $arr = explode(',', $this->resultDiZhi['trans_di_zhi']);
            return $this->transToArr($arr, 5);
        }

        return $res;
    }

    /**
     * 本爻与化爻的入墓关系  注意：只能本爻入化爻
     * @param $ben_positions
     * @param $trans
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombBen2Trans($ben_positions, $trans, $jxs, $mu_kus)
    {
        if (empty($trans)) {
            return [];
        }
        //1、首先看化爻的个数
        $res = [];
        foreach ($trans as $tran) {
            //2、如果是墓库,则看本卦是不是将星
            if (in_array($tran['dz'], $mu_kus)) {
                $row = collect($this->ruMu)->where('ru', $tran['dz'])->first();
                $ben = collect($ben_positions)->where('row', $tran['row'])->first();
                if (in_array($ben['dz'], $row['ru_mu']) && !in_array($ben['column'].$ben['row'], $jxs)) {
                    $terminal_point = $tran['column'] . $tran['row'];
                    $start_point = $ben['column'] . $ben['row'];
                    $res[] = $start_point . '-' . $terminal_point;
                }
            }
        }

        return $res;
    }

    /**
     * 本卦与日令的入墓关系
     * @param $ben_positions
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombBenDay($ben_positions, $jxs, $mu_kus)
    {
        if (empty($ben_positions)) {
            return [];
        }

        $end_positions = [
            ['dz' => $this->diZhiDay, 'column' => '6', 'row' => '2']
        ];

        return $this->getEnterTombWithOnlyOneStart($ben_positions, $end_positions, $jxs, $mu_kus);
    }

    /**
     * 获取从指定起点到终点的入墓关系
     * @param $start
     * @param $end
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombWithOnlyOneStart($start, $end, $jxs, $mu_kus)
    {
        return $this->getEnterTombRelation($start, $end, $jxs, $mu_kus);
    }

    /**
     * 日令与化爻之间的入墓关系
     * @param $trans
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombTransDay($trans, $jxs, $mu_kus)
    {
        if (empty($trans)) {
            return [];
        }

        $end_positions = [
            ['dz' => $this->diZhiDay, 'column' => '6', 'row' => '2']
        ];

        return $this->getEnterTombWithOnlyOneStart($trans, $end_positions, $jxs, $mu_kus);
    }

    /**
     * 获取本爻与月令之间的关系
     * @param $ben_positions
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombBenMonth($ben_positions, $jxs, $mu_kus)
    {
        if (empty($ben_positions)) {
            return [];
        }

        $end_positions = [
            ['dz' => $this->diZhiMonth, 'column' => '6', 'row' => '1']
        ];

        return $this->getEnterTombWithOnlyOneStart($ben_positions, $end_positions, $jxs, $mu_kus);
    }

    /**
     * 获取化爻与月令之间的关系
     * @param $trans
     * @param $jxs
     * @param $mu_kus
     * @return array
     */
    public function getEnterTombTransMonth($trans, $jxs, $mu_kus)
    {
        if (empty($trans)) {
            return [];
        }

        $end_positions = [
            ['dz' => $this->diZhiMonth, 'column' => '6', 'row' => '1']
        ];

        return $this->getEnterTombWithOnlyOneStart($trans, $end_positions, $jxs, $mu_kus);
    }

    /**
     * 去除所有的将星
     * @param $positions
     * @param $jxs
     * @return array
     */
    public function reduceJx($positions, $jxs)
    {
        $positions = collect($positions)->filter(function ($value, $key) use ($jxs) {
            return !in_array($value['dz'], $jxs);
        })->toArray();
        return $positions;
    }

    /**
     * 获取本卦中的纯动爻
     * @return array
     */
    public function getBenPureDong()
    {
        $dongs = array_values(Arr::where($this->benGuaDetail, function ($item, $key) {
            return $item['is_dong'];
        }));

        $dongs = array_reverse($dongs);

        return $dongs;
    }

}
