<?php

namespace Maturest\Trigram\Traits\Fortune;

trait HonourableMenTrait
{

    public function honourableMen()
    {
        $honourable_men = [];
        $six_qin = $this->getGrowGodSixQin();
        $position = $this->getGrowGodPosition($six_qin);

        $honourable_men[] = $this->honourLevel($position, $six_qin);

        $honourable_men = array_merge($honourable_men, $this->getAttributeGrowShi());
        $honourable_men[] = $this->whoIsMyHonourableMen($six_qin);

        return $honourable_men;
    }

    protected function getGrowGodSixQin()
    {
        $god_position = $this->god_positions[0];
        $six_qin = $this->getSixQinByWx($this->getWhoGrowMe($god_position['wx']));
        return $six_qin;
    }

    protected function getGrowGodPosition($six_qin)
    {
        $honour_positions = $this->getGodPositionsWithSixQin($six_qin);
        return $honour_positions[0];
    }

    protected function honourLevel($position, $font)
    {
        $hasNoOneHeCongRuKe = !$this->hasOneKeCongHeRu($position);
        $isHuiJu = $this->isHuiJuByFont($font);
        $dateGrowAndEqual = $this->dateGrowEqual($position['wx']);
        $isYaoGrow = $this->getIsTransGrowDong();

        if ($hasNoOneHeCongRuKe && (($isHuiJu && $dateGrowAndEqual) || ($isHuiJu && $isYaoGrow) || ($dateGrowAndEqual && $isYaoGrow))) {
            return '贵人运相当旺。';
        }

        if ($hasNoOneHeCongRuKe && $isHuiJu && ($dateGrowAndEqual || $isYaoGrow)) {
            return '贵人运旺。';
        }

        if ($hasNoOneHeCongRuKe && ($isYaoGrow || $dateGrowAndEqual)) {
            return '贵人运较旺。';
        }

        if (!$hasNoOneHeCongRuKe && ($isHuiJu || $dateGrowAndEqual || $isYaoGrow)) {
            return '贵人运有起伏。';
        }

        if (!$hasNoOneHeCongRuKe && !$dateGrowAndEqual) {
            return '贵人运需加强。';
        }

        return '';
    }

    protected function getAttributeGrowShi()
    {
        $position = $this->getShiOrYingPosition();
        $wx = $this->getWhoGrowMe($position['wx']);

        $attributes = [
            ['wx' => '木', 'letters' => ['贵人外貌多为身材瘦瘦高高，脸色偏青，脸部中段平直，下巴偏窄的人。', '贵人助力方向主要在正东方及东北偏东方。', '贵人运在寅、卯月以及每月的寅、卯日较旺。']],
            ['wx' => '火', 'letters' => ['贵人外貌多为身材圆胖、丰满，有点菱形脸，皮肤偏红，脸形上下比较尖的。', '贵人助力方向主要在正南方及东南偏南方。', '贵人运在巳、午月以及每月的巳、午日较旺。']],
            ['wx' => '土', 'letters' => ['贵人外貌多为身材偏矮四肢偏短，脸色偏黄，脸圆背后、唇厚、手背厚、蒜头鼻，行动沉重稳实。', '贵人助力方向主要在东北偏北方、东南偏东方、西南偏南方及西北偏西方。', '贵人运在丑、辰、未、戌月以及每月的丑、辰、未、戌日较旺。']],
            ['wx' => '金', 'letters' => ['贵人外貌多为身材单薄，肤色偏白，国字型脸，脸色白眉清目秀，口齿伶俐。', '贵人助力方向主要在西南偏西方及正西方。', '贵人运在申、酉月以及每月的申、酉日较旺。']],
            ['wx' => '水', 'letters' => ['贵人外貌多为体型偏胖，面色偏黑，脸形比较圆偏大，耳朵偏大，行动偏迟缓。', '贵人助力方向主要在西北偏北方及正北方。', '贵人运在亥、子月以及每月的亥、子日较旺。']],
        ];

        $row = collect($attributes)->where('wx', $wx)->first();

        return $row['letters'];
    }

    protected function whoIsMyHonourableMen($six_qin)
    {
        $letters = [
            ['six_qin' => '兄', 'letter' => '贵人多为辈分、级别、年龄相仿者，如兄弟姐妹、合伙人、团队、朋友同事、竞争者等。',],
            ['six_qin' => '子', 'letter' => '贵人多为辈分或级别较低者、年龄较小者，如小孩、下属、粉丝、客户、晚辈等。',],
            ['six_qin' => '财', 'letter' => '贵人多为女性、妻子、女友、高净值人群等。',],
            ['six_qin' => '官', 'letter' => '贵人多为男性、丈夫、上级领导、有专业性、有权威性、政府机关等。',],
            ['six_qin' => '父', 'letter' => '贵人多为辈分、级别、年龄较长者，如父母、老师、老人等。',],
        ];

        $row = collect($letters)->where('six_qin', $six_qin)->first();

        return $row['letter'];
    }
}