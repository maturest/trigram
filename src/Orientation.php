<?php


namespace Maturest\Trigram;

use Exception;
use Illuminate\Support\Carbon;
use Maturest\Trigram\Exceptions\InvalidArgumentException;

class Orientation extends BaseService
{
    protected $positions = [
        ['zhi' => '子', 'strong' => '坐北朝南', 'weakness' => '坐南朝北', 'img' => 'orientation/south.png'],
        ['zhi' => '丑', 'strong' => '坐西朝东', 'weakness' => '坐东朝西', 'img' => 'orientation/east.png'],
        ['zhi' => '寅', 'strong' => '坐南朝北', 'weakness' => '坐北朝南', 'img' => 'orientation/north.png'],
        ['zhi' => '卯', 'strong' => '坐东朝西', 'weakness' => '坐西朝东', 'img' => 'orientation/west.png'],
        ['zhi' => '辰', 'strong' => '坐北朝南', 'weakness' => '坐南朝北', 'img' => 'orientation/south.png'],
        ['zhi' => '巳', 'strong' => '坐西朝东', 'weakness' => '坐东朝西', 'img' => 'orientation/east.png'],
        ['zhi' => '午', 'strong' => '坐南朝北', 'weakness' => '坐北朝南', 'img' => 'orientation/north.png'],
        ['zhi' => '未', 'strong' => '坐东朝西', 'weakness' => '坐西朝东', 'img' => 'orientation/west.png'],
        ['zhi' => '申', 'strong' => '坐北朝南', 'weakness' => '坐南朝北', 'img' => 'orientation/south.png'],
        ['zhi' => '酉', 'strong' => '坐西朝东', 'weakness' => '坐东朝西', 'img' => 'orientation/east.png'],
        ['zhi' => '戌', 'strong' => '坐南朝北', 'weakness' => '坐北朝南', 'img' => 'orientation/north.png'],
        ['zhi' => '亥', 'strong' => '坐东朝西', 'weakness' => '坐西朝东', 'img' => 'orientation/west.png'],
    ];

    /**
     * 通过阳历日期获取最强方位
     * @param $date
     * @return mixed
     */
    public function getResultBySolar($date)
    {
        $this->solar($date);
        return $this->getPosition($this->date_detail['ganzhi_year']);
    }

    protected function getPosition($gz_year)
    {
        return collect($this->positions)->where('zhi', $this->dzYear($gz_year))->first();
    }

    /**
     * 通过阴历获取最强方位
     * @param $date
     * @param bool $isLeapMonth
     * @return mixed
     */
    public function getResultByLunar($date, $isLeapMonth = false)
    {
        try {
            $this->lunar($date, $isLeapMonth);
        } catch (Exception $exception) {
            throw new InvalidArgumentException('阴历日期格式有误');
        }

        return $this->getPosition($this->date_detail['ganzhi_year']);
    }
}