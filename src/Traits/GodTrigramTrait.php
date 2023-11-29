<?php


namespace Maturest\Trigram\Traits;

use Illuminate\Support\Str;

trait GodTrigramTrait
{
    /**
     * e.g.:朝东拜神农大帝，化金煞，找回魂魄，找回元神，化解元神受制，请神农大帝加持护佑。
     */
    public function firstParagraph(): string
    {
        $letters = [
            ['wx' => '火', 'is_cong' => false, 'bai' => '朝东拜神农大帝，????请神农大帝加持护佑。'],
            ['wx' => '土', 'is_cong' => false, 'bai' => '朝南拜关圣帝君，????请关圣帝君加持护佑。'],
            ['wx' => '金', 'is_cong' => false, 'bai' => '朝西拜地藏王菩萨，????请地藏王菩萨加持护佑。'],
            ['wx' => '金', 'is_cong' => true, 'bai' => '朝西拜观世音菩萨，????请观世音菩萨加持护佑。'],
            ['wx' => '水', 'is_cong' => false, 'bai' => '朝西拜观世音菩萨，????请观世音菩萨加持护佑。'],
            ['wx' => '水', 'is_cong' => true, 'bai' => '朝北拜玄天上帝，????请玄天上帝加持护佑。'],
            ['wx' => '木', 'is_cong' => false, 'bai' => '朝北拜玄天上帝，????请玄天上帝加持护佑。'],
        ];
        $wx = $this->getGodWx();
        $is_cong = false;
        if (in_array($wx, ['金', '水']))  $is_cong = $this->getIsCongByPosition($this->god_positions[0]);
        $row = collect($letters)->where('wx', $wx)->where('is_cong', $is_cong)->first();

        return Str::replaceArray('?', $this->getGodConditions(), $row['bai']);
    }


    public function getGodConditions()
    {
        $res = [];
        $god_wx = $this->getGodWx();
        $res[] = $this->getHuaSha($god_wx);
        $res[] = $this->getWholeFortune('找回魂魄，');
        if (Str::contains($this->question, ['身体', '健康'])) $statement = ['找回元神，', '化解元神受制，'];
        else $statement = ['找回贵人助力，', '化解贵人受制，'];
        $res[] = $this->agnatePower($god_wx, $statement[0]);
        $res[] = $this->getDissolveRoad($god_wx, $statement[1]);

        return $res;
    }

    public function getDissolveRoad(string $god_wx, string $statement)
    {
        $positions = $this->getPositionsWhoGrowMe($god_wx);
        foreach ($positions as $position) {
            if ($this->getIsKeByPosition($position) || $this->getIsCongByPosition($position)) {
                return $statement;
            }
        }
        return '';
    }


    public function getGodResultSet(string $god): array
    {
        $result = [];
        $result[] = $this->firstParagraph();
        $result[] = $this->acc($god);
        return $result;
    }
}
