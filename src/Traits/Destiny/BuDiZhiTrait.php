<?php


namespace Maturest\Trigram\Traits\Destiny;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maturest\Trigram\Exceptions\InvalidArgumentException;

trait BuDiZhiTrait
{

    protected $date;

    protected $gzMonth;

    protected $gzDay;

    protected $diZhiDay;

    protected $diZhiMonth;

    protected $tianGanDay;

    protected $resultDiZhi = [
        'gua_bian' => '',
        'is_dangerous' => false,
        'dangerous_note' => '',
        'trans_di_zhi' => '',
    ];


    /**
     * It takes the current gua, and then it checks if it needs to be transformed. If it does, it
     * transforms it, and then it checks if the transformed gua is dangerous. If it is, it adds the
     * transformed gua to the result
     *
     * @return The result of the method is the object itself.
     */
    public function deployDiZhi()
    {
        $need_gua_bian = $this->upEqualDown();
        $ben_gua = $this->getBenGua();
        $arr = $this->getBaGuaByGua($ben_gua);

        if (Str::contains($this->gua, [3, 4])) {
            $trans = $this->transBenGua();
            $arr = array_merge($arr, $trans);
        }

        if ($need_gua_bian && !Str::contains($this->gua, [3, 4])) {
            $trans_gua = $this->getTransGua();
            $trans = $this->getBaGuaByGua($trans_gua);
            $arr['gua_bian'] = $trans['ben_gua'];
        }

        if (isset($arr['gua_bian'])) {
            $res = $this->getIsDangerous($arr);
            $arr = array_merge($arr, $res);
        }

        $this->resultDiZhi = array_merge($this->resultDiZhi, $arr);

        return $this;
    }


    /**
     * > If the first three lines of the gua are the same as the last three lines of the gua, then
     * return true, otherwise return false
     */
    public function upEqualDown()
    {
        $down = substr($this->gua, 0, 3);
        $up = substr($this->gua, 3);
        return $down == $up ? true : false;
    }


    /**
     * > If the gua contains 3 or 4, replace 3 with 1 and 4 with 2
     *
     * @return The ben gua of the gua.
     */
    public function getBenGua()
    {

        $ben_gua = $this->gua;

        if (Str::contains($this->gua, [3, 4])) {
            $ben_gua = str_replace('3', '1', $this->gua);
            $ben_gua = str_replace('4', '2', $ben_gua);
        }

        return $ben_gua;
    }


    /**
     * It returns the value of the key in the array.
     *
     * @param gua The gua number, from 1 to 64.
     *
     * @return The value of the key  in the array ->totalGua.
     */
    public function getBaGuaByGua($gua)
    {
        return Arr::get($this->totalGua, $gua);
    }


    /**
     * It takes a string of comma separated values and returns an array of the values in reverse order.
     *
     * @param di_zhi The address you want to convert.
     * @return mixed
     */
    public function diZhi2Arr($di_zhi)
    {
        $di_zhi = explode(',', $di_zhi);
        $arr = array_reverse($di_zhi);
        return $arr;
    }


    /**
     * > It takes a string of numbers separated by commas and a number, and returns a string of numbers
     * separated by commas
     *
     * @param gua_dz the gua's dizhi
     * @param day_cong the day of the month
     *
     * @return the coordinates of the dots that are being passed in.
     */
    public function markDarkOn($gua_dz, $day_cong)
    {
        $keys = array_keys(explode(',', $gua_dz), $day_cong);
        $dots = array_map(function ($val) {
            return '4' . (intval($val) + 1);
        }, $keys);
        $coords = $this->getCoordsByDots($dots);
        $this->draw['an_dong']['coords'] = $coords;
    }


    /**
     * > It parses the date and returns the corresponding ganzhi day and month, and the corresponding
     * tiangan and dizhi day and month
     *
     * @return The object itself.
     */
    public function parseDate()
    {
        try {
            $date = Carbon::parse($this->date)->format('Y-n-j-G');
        } catch (Exception $exception) {
            throw new InvalidArgumentException('日期参数不合法');
        }

        [$year, $month, $day, $hour] = explode('-', $date);
        $result = $this->calendar->solar($year, $month, $day, $hour);
        $this->gzMonth = mb_substr($result['ganzhi_month'], -1, 1) . '月';
        $this->diZhiMonth = mb_substr($result['ganzhi_month'], -1, 1);
        $this->gzDay = $result['ganzhi_day'] . '日';
        [$tian_gan, $dizhi] = mb_str_split($result['ganzhi_day']);
        $this->diZhiDay = $dizhi;
        $this->tianGanDay = $tian_gan;
        $this->dealWithSolarTerms();

        return $this;
    }

    /**
     * > If the current date is a solar term, then the ganzhi month of the previous day is used
     *
     * @return The last day of the month.
     */
    public function dealWithSolarTerms()
    {

        $json = file_get_contents(public_path('data/solar_terms.json'));
        $solar_terms = json_decode($json, true);
        $trigram_date = Carbon::parse($this->date);
        $solar_term = collect($solar_terms)->first(function ($value, $key) use ($trigram_date) {
            return $trigram_date->isSameDay($value['time']);
        });

        if ($solar_term && $trigram_date->lt($solar_term['time'])) {
            $last_day = Carbon::parse($this->date)->subDay()->format('Y-n-j-G');
            [$year, $month, $day, $hour] = explode('-', $last_day);
            $last_day_res = $this->calendar->solar($year, $month, $day, $hour);

            $this->gzMonth = mb_substr($last_day_res['ganzhi_month'], -1, 1) . '月';
            $this->diZhiMonth = mb_substr($last_day_res['ganzhi_month'], -1, 1);
        }
    }
}
