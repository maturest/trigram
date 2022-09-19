<?php


namespace Maturest\Trigram\Traits\Fortune;

use Illuminate\Support\Str;

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
            'dz' => $this->benGuaDetail[$index]['dz'],
            'wx' => $this->getWxByDz($this->benGuaDetail[$index]['dz']),
        ];

        return $position;
    }

    /**
     * 通过六亲获取用神的位置
     * @param $god
     * @return array|array[]
     */
    public function getGodPositionsWithSixQin($god)
    {
        if (Str::contains($this->resultDiZhi['liu_qin'], $god)) {
            return $this->getGodPositionsWithBenSixQin($god);
        }

        return $this->getGodPositionByFuYao($god);
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

        return array_unique($positions,SORT_REGULAR);
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
                ];
            }
        }

        return array_unique($positions,SORT_REGULAR);
    }

}