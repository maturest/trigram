<?php


namespace Maturest\Trigram;

use Exception;
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
     * It returns the position of the solar date.
     *
     * @param date The date you want to get the result.
     *
     * @return The position of the ganzhi_year in the array.
     */
    public function getResultBySolar($date)
    {
        $this->solar($date);
        return $this->getPosition($this->date_detail['ganzhi_year']);
    }

    /**
     * It returns the position of the given year.
     *
     * @param gz_year The year of the lunar calendar
     *
     * @return The first element in the collection that matches the condition.
     */
    protected function getPosition($gz_year)
    {
        return collect($this->positions)->where('zhi', $this->dzYear($gz_year))->first();
    }

    /**
     * It returns the position of the given date.
     *
     * @param date The date of the lunar calendar, the format is yyyy-mm-dd
     * @param isLeapMonth Whether it is a leap month, the default is false
     *
     * @return The return value is the position of the animal in the zodiac.
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