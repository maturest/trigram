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
    public function qiBlood()
    {
        $res = $this->getHeWx();

        if (empty($wxs)) {
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
}
