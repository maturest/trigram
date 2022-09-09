<?php


namespace Maturest\Trigram\Traits\Fortune;


trait ShieldTrait
{
    public function getShield($god)
    {
        $wxs = $this->getWxByGod($god);
        return $this->getShieldItems($wxs);
    }

    public function getShieldItems($wxs)
    {
        $wxs = $this->getGrowMeWxs($wxs);
        $letters = [
            ['wx' => '火', 'letter' => '建议您穿衣以绿色，紫色为主，红色、粉色为辅。'],
            ['wx' => '土', 'letter' => '建议您穿衣以红色、粉色为主，黄色，米色为辅。'],
            ['wx' => '金', 'letter' => '建议您穿衣以黄色，米色为主，白色为辅。'],
            ['wx' => '水', 'letter' => '建议您穿衣以白色为主，黑色、蓝色、咖啡色为辅。'],
            ['wx' => '木', 'letter' => '建议您穿衣以黑色、蓝色、咖啡色为主，绿色，紫色为辅。'],
        ];
        return collect($letters)->whereIn('wx', $wxs)->implode('letter', '');
    }
}