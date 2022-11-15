<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

trait GodTrait
{
    public function getGodPositions($god)
    {
        if ($god == '世') {
            return [
                $this->getShiOrYingPosition($god),
            ];
        }
        return $this->getGodPositionsWithSixQin($god);
    }

    public function getShiOrYingPosition($font = '世')
    {
        $shi_ying = explode(',', $this->resultDiZhi['shi_ying']);
        $index = array_search($font, $shi_ying);
        $position = [
            'position' => $this->benGuaDetail[$index]['column'] . $this->benGuaDetail[$index]['row'],
            'is_dong' => $this->benGuaDetail[$index]['is_dong'],
            'is_an_dong' => $this->benGuaDetail[$index]['is_an_dong'],
            'is_volt' => false,
            'is_trans' => false,
            'dz' => $this->benGuaDetail[$index]['dz'],
            'wx' => $this->getWxByDz($this->benGuaDetail[$index]['dz']),
        ];

        return $position;
    }

    public function getGodPositionsWithSixQin($god)
    {
        $ben_gods = [];

        if (Str::contains($this->resultDiZhi['liu_qin'], $god)) {
            $ben_gods = $this->getGodPositionsWithBenSixQin($god);
        }

        $trans_gods = $this->getGodPositionByTrans($god);

        $fu_yao_gods = $this->getGodPositionByFuYao($god);

        if ($fu_yao_gods) {
            return $fu_yao_gods;
        }

        $date_gods = $this->getGodPositionByDate($god);

        $positions = array_merge($ben_gods, $trans_gods, $fu_yao_gods,$date_gods);

        $positions = collect($positions)->map(function ($item) {

            if ( $item['is_date'] ) {
                $item['sort'] = 1000;
                return $item;
            }

            if ($item['is_dong'] || $item['is_an_dong']) {
                $item['sort'] = 999;
                return $item;
            }

            if ($item['is_trans']) {
                $item['sort'] = 888;
                return $item;
            }

            $item['sort'] = 666;
            return $item;
        })->sortByDesc('sort')->toArray();

        return $positions;
    }

    public function getGodPositionByDate($god)
    {
        $positions = [];

        $dzs = $this->getDateDz();

        //月令的权重大于日令
        foreach($dzs as $key => $dz){
            if ($god == $this->getSixQinByDz($dz)) {
                $positions[] = [
                    'position' => '6' . ($key + 1),
                    'is_dong' => false,
                    'is_an_dong' => false,
                    'dz' => $dz,
                    'wx' => $this->getWxByDz($dz),
                    'is_trans' => false,
                    'is_volt' => false,
                    'is_date' => true,
                ];
            }
        }

        $positions = array_reverse($positions);

        return $positions;
    }

    public function getGodPositionsWithBenSixQin($god)
    {
        $positions = [];

        $tmp_arr = explode(',', $this->resultDiZhi['liu_qin']);
        foreach ($tmp_arr as $key => $value) {
            if ($value == $god) {
                $position = [
                    'position' => $this->benGuaDetail[$key]['column'] . $this->benGuaDetail[$key]['row'],
                    'is_dong' => $this->benGuaDetail[$key]['is_dong'],
                    'is_an_dong' => $this->benGuaDetail[$key]['is_an_dong'],
                    'dz' => $this->benGuaDetail[$key]['dz'],
                    'wx' => $this->getWxByDz($this->benGuaDetail[$key]['dz']),
                    'is_trans' => false,
                    'is_volt' => false,
                    'is_date' => false,
                ];

                if ($this->benGuaDetail[$key]['is_dong'] || $this->benGuaDetail[$key]['is_an_dong']) {
                    return [
                        $position,
                    ];
                }

                $positions[] = $position;
            }
        }

        return array_unique($positions, SORT_REGULAR);
    }

    public function getGodPositionByTrans($god)
    {
        $trans = [];
        $arr = $this->getTransArr();
        foreach ($arr as $key => $dz) {
            if ($god == $this->getSixQinByDz($dz)) {
                $trans[] = [
                    'position' => '5' . ($key + 1),
                    'is_dong' => false,
                    'is_an_dong' => false,
                    'dz' => $dz,
                    'wx' => $this->getWxByDz($dz),
                    'is_trans' => true,
                    'is_volt' => false,
                    'is_date' => false,
                ];
            }
        }

        return $trans;
    }

    public function getSixQinByDz($dz)
    {
        return $this->getSixQinByWx($this->getWxByDz($dz));
    }

    public function getSixQinByWx($wx)
    {
        $row = collect($this->benGuaSixQin)->where('ben_gua', $this->resultDiZhi['ben_gua'])
            ->where('wx', $wx)->first();
        return $row['six_qin'];
    }

    public function getGodPositionByFuYao($god)
    {
        $positions = [];
        foreach ($this->draw['fu_yao'] as $fu_yao) {
            if (Str::startsWith($fu_yao['fu_yao'], '伏' . $god)) {
                $dz = mb_substr($fu_yao['fu_yao'], -1);

                $ben_yao = collect($this->benGuaDetail)
                    ->where('column', $fu_yao['position'][0])
                    ->where('row', $fu_yao['position'][1])
                    ->first();

                $positions[] = [
                    'position' => $fu_yao['position'],
                    'is_dong' => $ben_yao['is_dong'],
                    'is_an_dong' => $ben_yao['is_an_dong'],
                    'dz' => $dz,
                    'wx' => $this->getWxByDz($dz),
                    'is_trans' => false,
                    'is_volt' => true,
                    'is_date' => false,
                ];
            }
        }

        return array_unique($positions, SORT_REGULAR);
    }

}