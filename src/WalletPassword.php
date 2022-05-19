<?php


namespace Maturest\Trigram;

use Exception;
use Illuminate\Support\Carbon;
use Maturest\Trigram\Exceptions\InvalidArgumentException;
use Maturest\Trigram\Services\Calendar;

class WalletPassword
{
    // 六十甲子纳音表
    protected $naYin = [
        ['gz' => '甲子', 'fate' => '海中金', 'wx' => '金'],
        ['gz' => '乙丑', 'fate' => '海中金', 'wx' => '金'],
        ['gz' => '丙寅', 'fate' => '炉中火', 'wx' => '火'],
        ['gz' => '丁卯', 'fate' => '炉中火', 'wx' => '火'],
        ['gz' => '戊辰', 'fate' => '大林木', 'wx' => '木'],
        ['gz' => '己巳', 'fate' => '大林木', 'wx' => '木'],
        ['gz' => '庚午', 'fate' => '路旁土', 'wx' => '土'],
        ['gz' => '辛未', 'fate' => '路旁土', 'wx' => '土'],
        ['gz' => '壬申', 'fate' => '剑锋金', 'wx' => '金'],
        ['gz' => '癸酉', 'fate' => '剑锋金', 'wx' => '金'],
        ['gz' => '甲戌', 'fate' => '山头火', 'wx' => '火'],
        ['gz' => '乙亥', 'fate' => '山头火', 'wx' => '火'],
        ['gz' => '丙子', 'fate' => '涧下水', 'wx' => '水'],
        ['gz' => '丁丑', 'fate' => '涧下水', 'wx' => '水'],
        ['gz' => '戊寅', 'fate' => '城头土', 'wx' => '土'],
        ['gz' => '己卯', 'fate' => '城头土', 'wx' => '土'],
        ['gz' => '庚辰', 'fate' => '白蜡金', 'wx' => '金'],
        ['gz' => '辛巳', 'fate' => '白蜡金', 'wx' => '金'],
        ['gz' => '壬午', 'fate' => '杨柳木', 'wx' => '木'],
        ['gz' => '癸未', 'fate' => '杨柳木', 'wx' => '木'],
        ['gz' => '甲申', 'fate' => '泉中水', 'wx' => '水'],
        ['gz' => '乙酉', 'fate' => '泉中水', 'wx' => '水'],
        ['gz' => '丙戌', 'fate' => '屋上土', 'wx' => '土'],
        ['gz' => '丁亥', 'fate' => '屋上土', 'wx' => '土'],
        ['gz' => '戊子', 'fate' => '霹雳火', 'wx' => '火'],
        ['gz' => '己丑', 'fate' => '霹雳火', 'wx' => '火'],
        ['gz' => '庚寅', 'fate' => '松柏木', 'wx' => '木'],
        ['gz' => '辛卯', 'fate' => '松柏木', 'wx' => '木'],
        ['gz' => '壬辰', 'fate' => '长流水', 'wx' => '水'],
        ['gz' => '癸巳', 'fate' => '长流水', 'wx' => '水'],
        ['gz' => '甲午', 'fate' => '砂石金', 'wx' => '金'],
        ['gz' => '乙未', 'fate' => '砂石金', 'wx' => '金'],
        ['gz' => '丙申', 'fate' => '山下火', 'wx' => '火'],
        ['gz' => '丁酉', 'fate' => '山下火', 'wx' => '火'],
        ['gz' => '戊戌', 'fate' => '平地木', 'wx' => '木'],
        ['gz' => '己亥', 'fate' => '平地木', 'wx' => '木'],
        ['gz' => '庚子', 'fate' => '壁上土', 'wx' => '土'],
        ['gz' => '辛丑', 'fate' => '壁上土', 'wx' => '土'],
        ['gz' => '壬寅', 'fate' => '金薄金', 'wx' => '金'],
        ['gz' => '癸卯', 'fate' => '金薄金', 'wx' => '金'],
        ['gz' => '甲辰', 'fate' => '覆灯火', 'wx' => '火'],
        ['gz' => '乙巳', 'fate' => '覆灯火', 'wx' => '火'],
        ['gz' => '丙午', 'fate' => '天河水', 'wx' => '水'],
        ['gz' => '丁未', 'fate' => '天河水', 'wx' => '水'],
        ['gz' => '戊申', 'fate' => '大驿土', 'wx' => '土'],
        ['gz' => '己酉', 'fate' => '大驿土', 'wx' => '土'],
        ['gz' => '庚戌', 'fate' => '钗环金', 'wx' => '金'],
        ['gz' => '辛亥', 'fate' => '钗环金', 'wx' => '金'],
        ['gz' => '壬子', 'fate' => '桑柘木', 'wx' => '木'],
        ['gz' => '癸丑', 'fate' => '桑柘木', 'wx' => '木'],
        ['gz' => '甲寅', 'fate' => '大溪水', 'wx' => '水'],
        ['gz' => '已卯', 'fate' => '大溪水', 'wx' => '水'],
        ['gz' => '丙辰', 'fate' => '沙中土', 'wx' => '土'],
        ['gz' => '丁巳', 'fate' => '沙中土', 'wx' => '土'],
        ['gz' => '戊午', 'fate' => '天上火', 'wx' => '火'],
        ['gz' => '己未', 'fate' => '天上火', 'wx' => '火'],
        ['gz' => '庚申', 'fate' => '石榴木', 'wx' => '木'],
        ['gz' => '辛酉', 'fate' => '石榴木', 'wx' => '木'],
        ['gz' => '壬戌', 'fate' => '大海水', 'wx' => '水'],
        ['gz' => '癸亥', 'fate' => '大海水', 'wx' => '水'],
    ];

    // 新钞
    protected $newBanknotes = [
        ['wx' => '金', 'banknotes' => 2100],
        ['wx' => '木', 'banknotes' => 2700],
        ['wx' => '水', 'banknotes' => 2300],
        ['wx' => '火', 'banknotes' => 2500],
        ['wx' => '土', 'banknotes' => 2900],
    ];

    // 钱包颜色配置
    protected $walletColors = [
        ['month' => '1', 'primary' => ['black', 'gray'], 'secondary' => ['brown'], 'note' => '黑色、灰色为主，咖啡色为辅', 'img' => 'wallet/bgb.png'],
        ['month' => '2', 'primary' => ['black', 'gray'], 'secondary' => ['brown'], 'note' => '黑色、灰色为主，咖啡色为辅', 'img' => 'wallet/bgb.png'],
        ['month' => '3', 'primary' => ['yellow'], 'secondary' => ['red'], 'note' => '黄色为主，红色为辅', 'img' => 'wallet/yr.png'],
        ['month' => '4', 'primary' => ['brown', 'blue'], 'secondary' => ['purple'], 'note' => '咖啡色、蓝色为主，紫色为辅', 'img' => 'wallet/bbp.png'],
        ['month' => '5', 'primary' => ['brown', 'blue'], 'secondary' => ['purple'], 'note' => '咖啡色、蓝色为主，紫色为辅', 'img' => 'wallet/bbp.png'],
        ['month' => '6', 'primary' => ['purple', 'green'], 'secondary' => ['red'], 'note' => '紫色、绿色为主，红色为辅', 'img' => 'wallet/pgr.png'],
        ['month' => '7', 'primary' => ['purple', 'green'], 'secondary' => ['red'], 'note' => '紫色、绿色为主，红色为辅', 'img' => 'wallet/pgr.png'],
        ['month' => '8', 'primary' => ['yellow'], 'secondary' => ['red'], 'note' => '黄色为主，红色为辅', 'img' => 'wallet/yr.png'],
        ['month' => '9', 'primary' => ['yellow'], 'secondary' => ['red'], 'note' => '黄色为主，红色为辅', 'img' => 'wallet/yr.png'],
        ['month' => '10', 'primary' => ['yellow'], 'secondary' => ['black', 'gray'], 'note' => '黄色为主，黑色、灰色为辅', 'img' => 'wallet/ybg.png'],
        ['month' => '11', 'primary' => ['yellow'], 'secondary' => ['black', 'gray'], 'note' => '黄色为主，黑色、灰色为辅', 'img' => 'wallet/ybg.png'],
        ['month' => '12', 'primary' => ['black', 'gray'], 'secondary' => ['brown'], 'note' => '黑色、灰色为主，咖啡色为辅', 'img' => 'wallet/bgb.png'],
    ];

    /**
     * 通过阴历日期获取钱包密码
     * @param string $date 阴历日期 如：2000-05-08
     * @param bool $isLeapMonth 标记是否是闰月
     * @return array
     * @throws InvalidArgumentException
     */
    public function getResultByLunar($date, $isLeapMonth = false)
    {
        try {
            //1、获取年的干支
            $calendar = $this->lunar($date, $isLeapMonth);

            //2、获取干支所对应的新钞数量
            $banknotes = $this->getNewBanknotes($calendar['gzYear']);

            //3、获取钱包颜色以及图片
            $wallet = $this->getWallet($calendar['lMonth']);
        } catch (Exception $exception) {
            throw new InvalidArgumentException('阴历日期格式有误');
        }

        return compact('banknotes', 'wallet');
    }

    /**
     * 获取阴历日期的数据
     * @param $date
     * @param bool $isLeapMonth
     * @return int|Services\JSON
     */
    protected function lunar($date, $isLeapMonth = false)
    {
        [$year, $month, $day] = explode('-', $date);
        $result = (new Calendar())->lunar2solar($year, $month, $day, $isLeapMonth);
        return $result;
    }

    /**
     * 获取新钞数量
     * @param $gz_year
     * @return int|mixed
     */
    protected function getNewBanknotes($gz_year)
    {
        $na_yin = $this->getNaYin($gz_year);
        $banknote = $this->getBanknote($na_yin['wx']);
        return $banknote['banknotes'] ?? 0;
    }

    /**
     * 获取纳音行
     * @param $gz_year
     * @return mixed
     */
    protected function getNaYin($gz_year)
    {
        return collect($this->naYin)->where('gz', $gz_year)->first();
    }

    /**
     * 获取新钞行
     * @param $wx
     * @return mixed
     */
    protected function getBanknote($wx)
    {
        return collect($this->newBanknotes)->where('wx', $wx)->first();
    }

    /**
     * 获取钱包
     * @param $lunar_month
     * @return mixed
     */
    protected function getWallet($lunar_month)
    {
        return collect($this->walletColors)->where('month', $lunar_month)->first();
    }

    /**
     * @param $date
     * @return array
     * @throws InvalidArgumentException
     */
    public function getResultBySolar($date)
    {
        try {
            //1、获取年的干支
            $calendar = $this->solar($date);

            //2、获取干支所对应的新钞数量
            $banknotes = $this->getNewBanknotes($calendar['gzYear']);

            //3、获取钱包颜色以及图片
            $wallet = $this->getWallet($calendar['lMonth']);
        } catch (Exception $exception) {
            throw new InvalidArgumentException('阳历日期格式有误');
        }

        return compact('banknotes', 'wallet');
    }

    /**
     * 获取阳历日期的数据
     * @param $date
     * @return int|Services\JSON
     */
    protected function solar($date)
    {
        $format = Carbon::parse($date)->format('Y-n-j');
        [$year, $month, $day] = explode('-', $format);
        $result = (new Calendar())->solar2lunar($year, $month, $day);
        return $result;
    }
}