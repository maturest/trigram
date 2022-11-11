<?php


namespace Maturest\Trigram\Traits\Destiny;


use Illuminate\Support\Arr;

trait EnterTombTrait
{

    protected $ruMuImages = [
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
        '41-51' => ['left_top' => ['397', '146'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '130'], 'font' => '入'],
        '42-52' => ['left_top' => ['397', '268'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '252'], 'font' => '入'],
        '43-53' => ['left_top' => ['397', '391'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '375'], 'font' => '入'],
        '44-54' => ['left_top' => ['397', '513'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '497'], 'font' => '入'],
        '45-55' => ['left_top' => ['397', '636'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '620'], 'font' => '入'],
        '46-56' => ['left_top' => ['397', '758'], 'img' => 'enter_tomb/41-51.png', 'middle' => ['405', '742'], 'font' => '入'],
        '41-61' => ['left_top' => ['383', '173'], 'img' => 'enter_tomb/61-41.png', 'middle' => ['485', '192'], 'mid_img' => 'fonts/ru.png'],
        '42-61' => ['left_top' => ['378', '230'], 'img' => 'enter_tomb/61-42.png', 'middle' => ['464', '224'], 'mid_img' => 'fonts/ru.png'],
        '43-61' => ['left_top' => ['387', '244'], 'img' => 'enter_tomb/61-43.png', 'middle' => ['488', '286'], 'mid_img' => 'fonts/ru.png'],
        '44-61' => ['left_top' => ['383', '269'], 'img' => 'enter_tomb/61-44.png', 'middle' => ['484', '408'], 'mid_img' => 'fonts/ru.png'],
        '45-61' => ['left_top' => ['384', '291'], 'img' => 'enter_tomb/61-45.png', 'middle' => ['488', '508'], 'mid_img' => 'fonts/ru.png'],
        '46-61' => ['left_top' => ['382', '314'], 'img' => 'enter_tomb/61-46.png', 'middle' => ['507', '588'], 'mid_img' => 'fonts/ru.png'],
        '41-62' => ['left_top' => ['385', '168'], 'img' => 'enter_tomb/62-41.png', 'middle' => ['498', '293'], 'mid_img' => 'fonts/ru.png'],
        '42-62' => ['left_top' => ['386', '296'], 'img' => 'enter_tomb/62-42.png', 'middle' => ['495', '401'], 'mid_img' => 'fonts/ru.png'],
        '43-62' => ['left_top' => ['388', '422'], 'img' => 'enter_tomb/62-43.png', 'middle' => ['496', '460'], 'mid_img' => 'fonts/ru.png'],
        '44-62' => ['left_top' => ['390', '537'], 'img' => 'enter_tomb/62-44.png', 'middle' => ['486', '545'], 'mid_img' => 'fonts/ru.png'],
        '45-62' => ['left_top' => ['381', '553'], 'img' => 'enter_tomb/62-45.png', 'middle' => ['463', '576'], 'mid_img' => 'fonts/ru.png'],
        '46-62' => ['left_top' => ['382', '565'], 'img' => 'enter_tomb/62-46.png', 'middle' => ['483', '651'], 'mid_img' => 'fonts/ru.png'],
        '51-61' => ['left_top' => ['491', '159'], 'img' => 'enter_tomb/61-51.png', 'middle' => ['526', '178'], 'mid_img' => 'fonts/ru.png'],
        '52-61' => ['left_top' => ['489', '233'], 'img' => 'enter_tomb/61-52.png', 'middle' => ['525', '246'], 'mid_img' => 'fonts/ru.png'],
        '53-61' => ['left_top' => ['485', '249'], 'img' => 'enter_tomb/61-53.png', 'middle' => ['516', '315'], 'mid_img' => 'fonts/ru.png'],
        '54-61' => ['left_top' => ['484', '271'], 'img' => 'enter_tomb/61-54.png', 'middle' => ['519', '393'], 'mid_img' => 'fonts/ru.png'],
        '55-61' => ['left_top' => ['482', '293'], 'img' => 'enter_tomb/61-55.png', 'middle' => ['520', '464'], 'mid_img' => 'fonts/ru.png'],
        '56-61' => ['left_top' => ['482', '311'], 'img' => 'enter_tomb/61-56.png', 'middle' => ['525', '536'], 'mid_img' => 'fonts/ru.png'],
        '51-62' => ['left_top' => ['482', '158'], 'img' => 'enter_tomb/62-51.png', 'middle' => ['529', '310'], 'mid_img' => 'fonts/ru.png'],
        '52-62' => ['left_top' => ['482', '283'], 'img' => 'enter_tomb/62-52.png', 'middle' => ['524', '376'], 'mid_img' => 'fonts/ru.png'],
        '53-62' => ['left_top' => ['485', '404'], 'img' => 'enter_tomb/62-53.png', 'middle' => ['523', '444'], 'mid_img' => 'fonts/ru.png'],
        '54-62' => ['left_top' => ['485', '522'], 'img' => 'enter_tomb/62-54.png', 'middle' => ['521', '520'], 'mid_img' => 'fonts/ru.png'],
        '55-62' => ['left_top' => ['489', '537'], 'img' => 'enter_tomb/62-55.png', 'middle' => ['525', '580'], 'mid_img' => 'fonts/ru.png'],
        '56-62' => ['left_top' => ['491', '554'], 'img' => 'enter_tomb/62-56.png', 'middle' => ['526', '647'], 'mid_img' => 'fonts/ru.png'],
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


    protected $ruMu = [
        ['ru_mu' => ['巳', '午'], 'ru' => '戌', 'jx' => '午'],
        ['ru_mu' => ['寅', '卯'], 'ru' => '未', 'jx' => '卯'],
        ['ru_mu' => ['子', '亥'], 'ru' => '辰', 'jx' => '亥'],
        ['ru_mu' => ['申', '酉'], 'ru' => '丑', 'jx' => '酉'],
    ];


    /**
     * It takes a bunch of arrays of positions, and returns an array of positions that are in the tomb
     */
    public function handleEnterTomb()
    {
        $ben_positions = $this->getAllBenPositions();

        $jxs = $this->getAllJX();

        $mu_kus = collect($this->ruMu)->pluck('ru')->toArray();

        $ben_tomb = $this->getEnterTombByB2B($ben_positions, $jxs, $mu_kus);

        $trans = $this->getAllHuaPositions();

        $ben_trans_tomb = $this->getEnterTombBen2Trans($ben_positions, $trans, $jxs, $mu_kus);

        $day_ben_tomb = $this->getEnterTombBenDay($ben_positions, $jxs, $mu_kus);

        $day_trans = $this->getEnterTombTransDay($trans, $jxs, $mu_kus);

        $month_ben = $this->getEnterTombBenMonth($ben_positions, $jxs, $mu_kus);

        $month_hua_tomb = $this->getEnterTombTransMonth($trans, $jxs, $mu_kus);

        $res = array_merge($ben_tomb, $ben_trans_tomb, $day_ben_tomb,
            $day_trans, $month_ben, $month_hua_tomb);

        $this->draw['ru_mu'] = collect($res)->unique()->toArray();

        return $this;
    }

   /**
    * It returns the value of the private property
    *
    * @return The function getBenDong is being returned.
    */
    public function getAllBenPositions()
    {
        return $this->getBenDong();
    }


    /**
     * It returns the dong gua of the ben gua.
     *
     * @return the array of the ben gua detail that is dong or an dong.
     */
    public function getBenDong()
    {
        $dongs = array_values(Arr::where($this->benGuaDetail, function ($item, $key) {
            return $item['is_dong'] || $item['is_an_dong'];
        }));

        $dongs = array_reverse($dongs);

        return $dongs;
    }


    /**
     * It returns an array of all the jx positions in the draw.
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
     * It checks if the draw['hui_ju'] is set and if it is true.
     */
    public function isJxExists()
    {
        return isset($this->draw['hui_ju']) && $this->draw['hui_ju'];
    }


    /**
     * It takes an array of positions, and returns an array of positions
     *
     * @param positions the position of the tombstone, which is an array, and the array is an array of
     * the following format:
     * @param jxs the number of the tombstone
     * @param mu_kus the number of people who have entered the tomb
     */
    public function getEnterTombByB2B($positions, $jxs, $mu_kus)
    {
        if (empty($positions)) {
            return [];
        }

        return $this->getEnterTombWithTwoPoints($positions, $positions, $jxs, $mu_kus);
    }


    /**
     * It takes two points and returns all the tombs that can be entered by starting at either of the
     * two points
     *
     * @param one the first point
     * @param two the second point
     * @param jxs the number of jie xing stones
     * @param mu_kus the number of tombs that are in the cemetery
     *
     * @return An array of tomb ids that are connected to the two points.
     */
    public function getEnterTombWithTwoPoints($one, $two, $jxs, $mu_kus)
    {
        $tombs_start_with_one = $this->getEnterTombRelation($one, $two, $jxs, $mu_kus);

        $tombs_start_with_two = $this->getEnterTombRelation($two, $one, $jxs, $mu_kus);

        return array_merge($tombs_start_with_one, $tombs_start_with_two);
    }


    /**
     * It takes in a list of start positions, a list of end positions, a list of forbidden positions,
     * and a list of forbidden positions, and returns a list of valid moves
     *
     * @param start_positions the starting position of the tomb
     * @param end_positions the position of the tomb
     * @param jxs the position of the tomb
     * @param mu_kus the array of the tomb's positions
     */
    public function getEnterTombRelation($start_positions, $end_positions, $jxs, $mu_kus)
    {
        $res = [];
        foreach ($end_positions as $end_position) {
            $end_dz = $end_position['dz'];

            if (in_array($end_dz, $mu_kus)) {
                $row = collect($this->ruMu)->where('ru', $end_dz)->first();

                foreach ($start_positions as $start_position) {
                    if (isset($start_position['is_an_dong']) && $start_position['is_an_dong']) {
                        continue;
                    }

                    if (in_array($start_position['dz'], $row['ru_mu']) && !in_array($start_position['column'] . $start_position['row'], $jxs)) {
                        $terminal_point = $end_position['column'] . $end_position['row'];
                        $start_point = $start_position['column'] . $start_position['row'];
                        $res[] = $start_point . '-' . $terminal_point;
                    }
                }
            }
        }
        return $res;
    }

    /**
     * It returns an array of the positions of the HuaGua in the Gua
     */
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
     * It takes an array of positions, an array of transitions, an array of jxs, and an array of
     * mu_kus, and returns an array of strings
     *
     * @param ben_positions the position of the ben
     * @param trans the position of the tombstone
     * @param jxs the position of the tombstone
     * @param mu_kus the position of the tombstone
     */
    public function getEnterTombBen2Trans($ben_positions, $trans, $jxs, $mu_kus)
    {
        if (empty($trans)) {
            return [];
        }

        $res = [];
        foreach ($trans as $tran) {
            if (in_array($tran['dz'], $mu_kus)) {
                $row = collect($this->ruMu)->where('ru', $tran['dz'])->first();
                $ben = collect($ben_positions)->where('row', $tran['row'])->first();
                if (in_array($ben['dz'], $row['ru_mu']) && !in_array($ben['column'] . $ben['row'], $jxs)) {
                    $terminal_point = $tran['column'] . $tran['row'];
                    $start_point = $ben['column'] . $ben['row'];
                    $res[] = $start_point . '-' . $terminal_point;
                }
            }
        }

        return $res;
    }


    /**
     * It returns an array of the positions of the tomb of the day.
     *
     * @param ben_positions the position of the tomb
     * @param jxs the position of the palace of the palace
     * @param mu_kus the tomb of the deceased
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
     * It returns the result of the getEnterTombRelation function.
     *
     * @param start the start date of the period you want to query
     * @param end the end of the tomb
     * @param jxs the number of jiexing stones you have
     * @param mu_kus the number of people who are going to enter the tomb
     */
    public function getEnterTombWithOnlyOneStart($start, $end, $jxs, $mu_kus)
    {
        return $this->getEnterTombRelation($start, $end, $jxs, $mu_kus);
    }


    /**
     * It returns an array of the following format:
     *
     * @param trans the array of the day's transit
     * @param jxs the position of the tomb
     * @param mu_kus the tomb of the deceased
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
     * It returns an array of the positions of the ben month.
     *
     * @param ben_positions the position of the year of birth
     * @param jxs the position of the palace of the month
     * @param mu_kus the tomb of the dead
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
     * It returns an array of the month of the year when the person will enter the tomb.
     *
     * @param trans the array of the month's flying stars
     * @param jxs the position of the month's stem
     * @param mu_kus the tomb of the month
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
     * > It takes an array of positions and an array of jxs and returns an array of positions that
     * don't have a jx in the jxs array
     *
     * @param positions the array of positions
     * @param jxs the array of positions to be removed
     */
    public function reduceJx($positions, $jxs)
    {
        $positions = collect($positions)->filter(function ($value, $key) use ($jxs) {
            return !in_array($value['dz'], $jxs);
        })->toArray();
        return $positions;
    }


    /**
     * It returns the dong gua of the ben gua.
     *
     * @return The array of dongs in the ben gua.
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
