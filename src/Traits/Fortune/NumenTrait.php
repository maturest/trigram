<?php


namespace Maturest\Trigram\Traits\Fortune;

trait NumenTrait
{
    public function numen()
    {
        return $this->getLetters($this->getGodWx());
    }

    public function getLetters($wx)
    {
        $letters = [
            ['wx' => '火', 'letter' => ['朝东拜神农大帝', '【常去寺庙跟守护神做链接，或多观想守护神】']],
            ['wx' => '土', 'letter' => ['朝南拜关圣帝君', '【常去寺庙跟守护神做链接，或多观想守护神】']],
            ['wx' => '金', 'letter' => ['朝西拜地藏王菩萨', '【常去寺庙跟守护神做链接，或多观想守护神】']],
            ['wx' => '水', 'letter' => ['朝西拜观世音菩萨', '【常去寺庙跟守护神做链接，或多观想守护神】']],
            ['wx' => '木', 'letter' => ['朝北拜玄天上帝', '【常去寺庙跟守护神做链接，或多观想守护神】']],
        ];

        $row = collect($letters)->where('wx', $wx)->first();

        return $row['letter'];
    }
}
