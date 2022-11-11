<?php


namespace Maturest\Trigram;

use Exception;
use Illuminate\Support\Carbon;
use Maturest\Trigram\Exceptions\InvalidArgumentException;

class BaseService
{

    protected $date_detail;

    /**
     * @param $date
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function solar($date)
    {
        try {
            $format = Carbon::parse($date)->format('Y-n-j-G');
            [$year, $month, $day, $hour] = explode('-', $format);
            //初始化属性
            $this->date_detail = app('calendar')->solar($year, $month, $day, $hour);
        } catch (Exception $exception) {
            throw new InvalidArgumentException('阳历日期格式有误');
        }
    }

    /**
     * @param $date
     * @param bool $isLeapMonth
     * @return int|Services\JSON
     * @throws Exception
     */
    protected function lunar($date, $isLeapMonth = false)
    {
        try {
            $format = Carbon::parse($date)->format('Y-n-j-G');
            [$year, $month, $day, $hour] = explode('-', $format);
            $this->date_detail = app('calendar')->lunar($year, $month, $day, $isLeapMonth, $hour);
        } catch (Exception $exception) {
            throw new InvalidArgumentException('阳历日期格式有误');
        }
    }

    /**
     * @param $gz
     * @return mixed|string
     */
    protected function dzYear($gz)
    {
        $arr = mb_str_split($gz);
        return array_pop($arr);
    }
}