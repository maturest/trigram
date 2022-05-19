<?php


namespace Maturest\Trigram\Traits;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maturest\Trigram\Exceptions\InvalidArgumentException;

trait BuDiZhiTrait
{
    // 卜卦日期
    protected $date;

    // 卜卦日期月地支（带月）
    protected $gzMonth;

    // 卜卦日期的天干地支(带日)
    protected $gzDay;

    // 卜卦日期 日地支
    protected $diZhiDay;

    // 卜卦日期 月地支
    protected $diZhiMonth;

    // 卜卦日期 天干
    protected $tianGanDay;

    // 最终部地支的结果
    protected $resultDiZhi = [
        'gua_bian' => '',
        'is_dangerous' => false,
        'dangerous_note' => '',
        'trans_di_zhi' => '',
    ];

    /**
     * 部地支 外带卦变
     * @return $this
     */
    public function deployDiZhi()
    {
        // 是否需要卦变
        $need_gua_bian = $this->upEqualDown();

        // 获取本卦
        $ben_gua = $this->getBenGua();
        $arr = $this->getBaGuaByGua($ben_gua);

        //如果本卦中存在动爻，则需要化爻，即将老阳转化为阴，将老阴转化为阳
        if (Str::contains($this->gua, [3, 4])) {
            $trans = $this->transBenGua();
            $arr = array_merge($arr, $trans);
        }

        // 如果是静爻并且上下卦一致的话，需要卦变,
        if ($need_gua_bian && !Str::contains($this->gua, [3, 4])) {
            $trans_gua = $this->getTransGua();
            $trans = $this->getBaGuaByGua($trans_gua);
            $arr['gua_bian'] = $trans['ben_gua'];
        }

        // 如果存在卦变 则标记此卦是否为凶卦
        if (isset($arr['gua_bian'])) {
            $res = $this->getIsDangerous($arr);
            $arr = array_merge($arr, $res);
        }
        $this->resultDiZhi = array_merge($this->resultDiZhi, $arr);

        return $this;
    }

    /**
     * 判断上下卦是否一致
     * @return bool
     */
    public function upEqualDown()
    {
        $down = substr($this->gua, 0, 3);
        $up = substr($this->gua, 3);
        return $down == $up ? true : false;
    }

    /**
     * 获取本卦
     * @return string
     */
    public function getBenGua()
    {
        //如果是纯静爻
        $ben_gua = $this->gua;
        //如果本卦中存在动爻 则需要将 老阳转化为阳 老阴转化为阴
        if (Str::contains($this->gua, [3, 4])) {
            $ben_gua = str_replace('3', '1', $this->gua);
            $ben_gua = str_replace('4', '2', $ben_gua);
        }
        return $ben_gua;
    }

    /**
     * 获取64卦中的一种
     * @param $gua
     * @return array
     */
    public function getBaGuaByGua($gua)
    {
        return Arr::get($this->totalGua, $gua);
    }

    /**
     * 获取反转后的地支数组
     * @param $di_zhi
     * @return array
     */
    public function diZhi2Arr($di_zhi)
    {
        $di_zhi = explode(',', $di_zhi);
        $arr = array_reverse($di_zhi);
        return $arr;
    }

    /**
     * 标记暗动的坐标位置
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
     * 解析卜卦日期，计算日令
     * @return $this
     */
    public function parseDate()
    {
        try {
            $date = Carbon::parse($this->date)->toDateString();
        } catch (Exception $exception) {
            throw new InvalidArgumentException('日期参数不合法');
        }

        [$year, $month, $day] = explode('-', $date);
        $result = $this->calendar->solar2lunar($year, $month, $day);
        $this->gzMonth = mb_substr($result['gzMonth'], -1, 1) . '月';
        $this->diZhiMonth = mb_substr($result['gzMonth'], -1, 1);
        $this->gzDay = $result['gzDay'] . '日';

        [$tian_gan, $dizhi] = mb_str_split($result['gzDay']);

        // 标记卜卦日期 地支
        $this->diZhiDay = $dizhi;
        //  标记卜卦日期 天干
        $this->tianGanDay = $tian_gan;

        return $this;
    }


}
