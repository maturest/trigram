<?php


namespace Maturest\Trigram\Traits\Fortune;

trait GoodIllTrait
{
    public function goodOrIll($god)
    {
        $wx = $this->getGodWx();
        return [
            $this->getGoods($wx, $god),
            $this->getIlls($wx, $god)
        ];
    }

    public function getGoods($wx, $god)
    {
        return $this->getGoodTime($wx) . $this->recommendDo($god);
    }

    public function getGoodTime($wx)
    {
        $letters = [
            ['wx' => '火', 'letter' => '适合在寅日、卯日做重大决定，清晨5点至7点，上午9点至中午13点前的黄金时间段可多思考做重要决策。'],
            ['wx' => '土', 'letter' => '适合在巳日、午日做重大决定，上午9点至中午13点前的黄金时间段可多思考做重要决策。'],
            ['wx' => '金', 'letter' => '适合在丑日、辰日、未日、戌日做重大决定，上午7-9点、下午13-15点、晚上19-21点的黄金时间段可多思考做重要决策。'],
            ['wx' => '水', 'letter' => '适合在申日、酉日做重大决定，下午15-19点的黄金时间段可多思考做重要决策。'],
            ['wx' => '木', 'letter' => '适合在子日、亥日做重大决定，晚上21点至凌晨1点前的黄金时间段可多思考做重要决策。'],
        ];
        $row = collect($letters)->where('wx', $wx)->first();
        return $row['letter'];
    }

    public function recommendDo($god)
    {
        $god = $god == '世' ? $this->getSixQinByShiOrYing() : $god;
        $letters = [
            ['god' => '兄', 'letter' => '可做事业、投资、家庭等方面的重要规划，宜多与长辈、长者交流互动。'],
            ['god' => '子', 'letter' => '可做团队策划、合伙决策、兄弟姐妹家庭商议等重要决定，宜多与同辈交流互动。'],
            ['god' => '财', 'letter' => '可做投资决策、对接项目资源、下属或粉丝管理等重要事宜，宜多与晚辈交流互动。'],
            ['god' => '父', 'letter' => '可做事业上的重大规划、树立品牌、对接高质量资源等重要规划，宜多与有名声者交流互动。'],
            ['god' => '官', 'letter' => '可做资金规划、树立品牌、亲密关系建设等重要决定，宜多与异性交流互动。'],
        ];
        $row = collect($letters)->where('god', $god)->first();
        return $row['letter'];
    }

    public function getIlls($wx, $god)
    {
        return $this->getBadTime($wx) . $this->recommendNotDo($god);
    }

    public function getBadTime($wx)
    {
        $letters = [
            ['wx' => '火', 'letter' => '避免在亥日、子日以及晚上21点至凌晨1点前做重大决定。'],
            ['wx' => '土', 'letter' => '避免在寅日、卯日以及清晨5点至7点。'],
            ['wx' => '金', 'letter' => '避免在巳日、午日以及上午9点至中午13点前做重大决定。'],
            ['wx' => '水', 'letter' => '避免在丑日、辰日、未日、戌日以及上午7-9点、下午13-15点、晚上19-21点的时间段做重大决定。'],
            ['wx' => '木', 'letter' => '避免在申日、酉日以及下午15-19点的时间段做重大决定。'],
        ];
        $row = collect($letters)->where('wx', $wx)->first();
        return $row['letter'];
    }

    public function recommendNotDo($god)
    {
        $god = $god == '世' ? $this->getSixQinByShiOrYing() : $god;
        $letters = [
            ['god' => '兄', 'letter' => '怕会引发不必要的是非口角或官非。'],
            ['god' => '子', 'letter' => '怕会带来过大的压力及意外事件。'],
            ['god' => '财', 'letter' => '怕会导致投资失误或破财现象。'],
            ['god' => '父', 'letter' => '怕会导致财务上的压力。'],
            ['god' => '官', 'letter' => '怕会引发烦心事及是非口角。'],
        ];
        $row = collect($letters)->where('god', $god)->first();
        return $row['letter'];
    }
}
