<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

/**
 * 获取用神
 * Trait GodTrait
 * @package Maturest\Trigram\Traits\Fortune
 */
trait GodTrait
{
    /**
     * 获取用神的位置
     * @param string $god 用神
     * @return array|array[]
     */
    public function getGodPositions($god)
    {
        if ($god == '世') {
            return [
                $this->getShiOrYingPosition($god),
            ];
        }
        return $this->getGodPositionsWithSixQin($god);
    }

    /**
     * 获取世应的位置
     * @param string $font
     * @return array
     */
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

    /**
     * 通过六亲获取用神的位置,用神多现，取旺相者，动爻大于静爻，本爻大于化爻，化爻大于静爻
     * @param $god
     * @return array|array[]
     */
    public function getGodPositionsWithSixQin($god)
    {
        // 本爻六亲与用神一致的情况
        if (Str::contains($this->resultDiZhi['liu_qin'], $god)) {
            $ben_gods = $this->getGodPositionsWithBenSixQin($god);
        }

        //化爻六亲与用神一致的情况
        $trans_gods = $this->getGodPositionByTrans($god);

        $fu_yao_gods = $this->getGodPositionByFuYao($god);

        if ($fu_yao_gods) {
            return $fu_yao_gods;
        }

        $positions = array_merge($ben_gods, $trans_gods, $fu_yao_gods);

        //比较权重 动爻大于化爻，化爻大于静爻
        $positions = collect($positions)->map(function ($item) {
            // 动爻
            if ($item['is_dong'] || $item['is_an_dong']) {
                $item['sort'] = 999;
                return $item;
            }
            // 化爻
            if ($item['is_trans']) {
                $item['sort'] = 888;
                return $item;
            }
            // 静爻
            $item['sort'] = 666;
            return $item;
        })->sortByDesc('sort')->toArray();

        return $positions;
    }

    /**
     * 获取本爻中六亲等于用神的位置
     * @param $god
     * @return array|array[]
     */
    public function getGodPositionsWithBenSixQin($god)
    {
        $positions = [];

        //如果六亲中包含用神，可能出现多个六亲，循环遍历
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
                ];

                //用神多现取旺相者，动爻大于静爻，本爻大于化爻
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

    /**
     * 获取化爻中六亲等于用神的位置
     * @param $god
     * @return array
     */
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
                ];
            }
        }

        return $trans;
    }

    /**
     * 通过地支获取对应的六亲
     * @param $dz
     * @return mixed
     */
    public function getSixQinByDz($dz)
    {
        return $this->getSixQinByWx($this->getWxByDz($dz));
    }

    /**
     * 通过五行找寻六亲
     * @param $wx
     * @return mixed
     */
    public function getSixQinByWx($wx)
    {
        $row = collect($this->benGuaSixQin)->where('ben_gua', $this->resultDiZhi['ben_gua'])
            ->where('wx', $wx)->first();
        return $row['six_qin'];
    }

    /**
     * 获取伏爻的用神的位置
     * @param $god
     * @return array
     */
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
                ];
            }
        }

        return array_unique($positions, SORT_REGULAR);
    }

}