<?php


namespace Maturest\Trigram\Traits\Fortune;


trait ShieldTrait
{
    /**
     * 获取五行护持
     * @return mixed
     */
    public function shield()
    {
        return $this->getShieldItems($this->getGodWx());
    }

    public function getShieldItems($wx)
    {
        $letters = [
            ['wx' => '火', 'letter' => '建议您穿衣以绿色，紫色为主，红色、粉色为辅。'],
            ['wx' => '土', 'letter' => '建议您穿衣以红色、粉色为主，黄色，米色为辅。'],
            ['wx' => '金', 'letter' => '建议您穿衣以黄色，米色为主，白色为辅。'],
            ['wx' => '水', 'letter' => '建议您穿衣以白色为主，黑色、蓝色、咖啡色为辅。'],
            ['wx' => '木', 'letter' => '建议您穿衣以黑色、蓝色、咖啡色为主，绿色，紫色为辅。'],
        ];
        $row = collect($letters)->where('wx', $this->getWhoGrowMe($wx))->first();
        return $row['letter'];
    }
}