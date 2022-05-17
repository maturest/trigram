<?php


namespace Maturest\Trigram\Traits;


trait DilemmaTrait
{

    protected $dilemmaPositions = [
        '41-51' => ['left_top' => ['397', '146'], 'img' => 'dilemma/dilemma.png', 'middle' => ['401', '130']],
        '42-52' => ['left_top' => ['397', '268'], 'img' => 'dilemma/dilemma.png', 'middle' => ['401', '252']],
        '43-53' => ['left_top' => ['397', '391'], 'img' => 'dilemma/dilemma.png', 'middle' => ['401', '375']],
        '44-54' => ['left_top' => ['397', '513'], 'img' => 'dilemma/dilemma.png', 'middle' => ['401', '497']],
        '45-55' => ['left_top' => ['397', '636'], 'img' => 'dilemma/dilemma.png', 'middle' => ['401', '620']],
        '46-56' => ['left_top' => ['397', '758'], 'img' => 'dilemma/dilemma.png', 'middle' => ['401', '742']],
    ];

    protected $dilemma = [
        ['ben_gua' => '巳', 'hua' => '午', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '申', 'hua' => '酉', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '亥', 'hua' => '子', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '寅', 'hua' => '卯', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '辰', 'hua' => '未', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '未', 'hua' => '戌', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '戌', 'hua' => '丑', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '丑', 'hua' => '辰', 'dilemma' => 'jin', 'font' => '进'],
        ['ben_gua' => '午', 'hua' => '巳', 'dilemma' => 'tui', 'font' => '退'],
        ['ben_gua' => '酉', 'hua' => '申', 'dilemma' => 'tui', 'font' => '退'],
        ['ben_gua' => '子', 'hua' => '亥', 'dilemma' => 'tui', 'font' => '退'],
        ['ben_gua' => '卯', 'hua' => '寅', 'dilemma' => 'tui', 'font' => '退'],
        ['ben_gua' => '未', 'hua' => '辰', 'dilemma' => 'tui', 'font' => '退'],
        ['ben_gua' => '戌', 'hua' => '未', 'dilemma' => 'tui', 'font' => '退'],
        ['ben_gua' => '丑', 'hua' => '戌', 'dilemma' => 'tui', 'font' => '退'],
        ['ben_gua' => '辰', 'hua' => '丑', 'dilemma' => 'tui', 'font' => '退'],
    ];

    /**
     * 处理进退神关系  注意：产品文档上写错了，不管进退，箭头都是从左往右
     * @return $this
     */
    public function handleDilemma()
    {
        $res = [];
        if ($this->transGuaExists()) {
            $trans = $this->getAllHuaPositions();
            $ben_positions = $this->getAllBenPositions();
            foreach ($trans as $tran) {
                $ben_gua = collect($ben_positions)->where('row', $tran['row'])->first();
                $row = collect($this->dilemma)->where('ben_gua', $ben_gua['dz'])
                    ->where('hua', $tran['dz'])->first();

                if ($row) {
                    $start = $ben_gua['column'] . $ben_gua['row'];
                    $end = $tran['column'] . $tran['row'];
                    $position = $start . '-' . $end;
                    $res[] = ['position' => $position, 'dilemma' => $row['dilemma'], 'font' => $row['font']];
                }
            }
        }

        $this->draw['jin_tui'] = $res;

        return $this;
    }


}
