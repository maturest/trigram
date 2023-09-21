<?php


namespace Maturest\Trigram\Traits;

trait BodyTrigramTrait
{

    /**
     * The function checks for blood stagnation in different body parts and provides recommendations
     * for better daily care, with an additional warning for potential serious conditions.
     *
     * @return a string that provides information about the presence of blood stasis in certain body
     * parts. The string includes recommendations for better daily care and, if applicable, a
     * suggestion to undergo a health check or seek medical attention if there are any discomfort or
     * concerns.
     */
    public function bodyHe()
    {
        $res = $this->getHeWx();

        if (empty($res)) {
            return false;
        }

        $wxs = collect($res)->pluck('wx')->unique()->toArray();
        $parts = $this->getParts($wxs);
        $str = "在{$parts}部位有气血淤堵的现象，建议更好的日常养护。";

        $serious = collect($res)->where('serious', true)->pluck('wx')->unique()->toArray();
        if ($serious) {
            $parts = $this->getParts($serious);
            $str .= "在{$parts}部位有气血淤堵的现象，恐有长硬物的隐患，建议进行健康检查，或有不适及时就医。";
        }

        return $str;
    }


    /**
     * The function "getParts" takes an array of weather conditions and returns a string containing the
     * corresponding body parts.
     *
     * @param wxs An array of elements representing the five elements (土, 金, 木, 水, 火).
     *
     * @return a string that contains the body parts associated with the given weather conditions. The
     * body parts are separated by commas.
     */
    protected function getParts($wxs)
    {
        $parts = [];

        $bodyParts = [
            ['wx' => '土', 'parts' => ['肠胃'],],
            ['wx' => '金', 'parts' => ['肺部'],],
            ['wx' => '木', 'parts' => ['肝脏'],],
            ['wx' => '水', 'parts' => ['肾脏', '血液'],],
            ['wx' => '火', 'parts' => ['心脏'],],
        ];

        foreach ($wxs as $wx) {
            $row = collect($bodyParts)->where('wx', $wx)->first();
            $parts = array_merge($parts, $row['parts']);
        }

        return implode('、', $parts);
    }


    /**
     * returns an array of information about positions based on the "six_he" array.
     *
     * @return an array of elements.
     */
    protected function getHeWx()
    {
        if (empty($this->draw['six_he'])) {
            return [];
        }

        $allPositions = $this->getAllPosition();

        $res = [];

        foreach ($this->draw['six_he'] as $six_he) {
            $tmp = [];
            $positions = explode('-', $six_he);
            foreach ($positions as $position) {
                $row = collect($allPositions)->where('column', $position[0])->where('row', $position[1])->first();
                $tmp['wx'] = $this->getWxByDz($row['dz']);
                $tmp['serious'] = '官' == $this->getSixQinByDz($row['dz']);
                $res[] = $tmp;
            }
        }

        return $res;
    }

    public function bodyChong()
    {
        $res = [];

        $six_chong = $this->draw['six_chong'];

        //1、merge handel dark on
        $coords = $this->draw['an_dong']['coords'];
        foreach ($coords as $coords) {
            $six_chong[] = '62-' . ($coords - 40);
        }

        $res = [];

        $allPositions = $this->getAllPosition();
        foreach ($six_chong as $arr) {
            $positions = explode('-', $arr);

            //start point
            $point_a = $positions[0];
            //end point
            $point_b = $positions[1];

            $row_a = collect($allPositions)->where('column', $point_a[0])->where('row', $point_a[1])->first();

            // 如果是辰戌、丑未冲
            if (in_array($row_a['dz'], ['辰', '戌', '丑', '未'])) {
                $res[] = '注意饮食和脾胃的调理，或有消化不良导致的肠胃胀气现象。';
            }

            // 如果是子午、巳亥冲，并且动爻对应的地支是午或巳，
            if (in_array($row_a['dz'], ['子', '午', '巳', '亥'])) {
                $row_b = collect($allPositions)->where('column', $point_b[0])->where('row', $point_b[1])->first();
                if (($point_a[0] == 6 && in_array($row_a['dz'], ['午', '巳']))
                    || ($point_b[0] == 6 && in_array($row_b['dz'], ['午', '巳']))
                ) {
                    $res[] = '注意身体的炎症隐患，避免由炎症引起的发热现象。';
                } else {
                    $res[] = '身体有炎症的隐患，易有心悸或伤寒发热的现象，注意心脏的养护。';
                }
            }

            // 如果是卯酉，寅申冲并且动爻对应的地支是卯或申
            if (in_array($row_a['dz'], ['卯', '酉', '寅', '申',])) {
                $row_b = collect($allPositions)->where('column', $point_b[0])->where('row', $point_b[1])->first();
                if (($point_a[0] == 6 && in_array($row_a['dz'], ['卯', '申']))
                    || ($point_b[0] == 6 && in_array($row_b['dz'], ['卯', '申']))
                ) {
                    $res[] = '注意肝脏的保养，神经性问题的隐患，避免脊柱侧弯或四肢受伤的现象。';
                } else {
                    $res[] = '注意或有脊柱侧弯的可能，避免四肢受伤的现象，注意肝胆养护。';
                }
            }
        }

        return array_unique($res);
    }
}
