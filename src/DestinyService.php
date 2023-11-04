<?php

namespace Maturest\Trigram;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maturest\Trigram\Exceptions\InvalidArgumentException;
use Maturest\Trigram\Traits\DestinyTrait;
use Maturest\Trigram\Traits\FortuneTrait;
use Maturest\Trigram\Traits\BodyTrigramTrait;
use Maturest\Trigram\Traits\GodTrigramTrait;

class DestinyService
{
    use DestinyTrait, FortuneTrait, BodyTrigramTrait, GodTrigramTrait;

    private static $instance;

    public $draw = [
        'kong_wang' => ['coords' => [], 'radius' => 20],
        'an_dong' => ['coords' => [], 'img' => 'dark_on/dark_on.png'],
        'six_chong' => [],
        'six_he' => [],
        'hui_ju' => [],
        'ru_mu' => [],
        'jin_tui' => [],
        'fu_yao' => [],
    ];

    protected $calendar;

    protected $gua;

    protected $question;

    protected $userName;

    protected $trigramType;

    protected $owner;

    protected $watermark;

    protected $transparent;

    /**
     * DestinyService constructor.
     * @param $date 1996-01-01 05:26:38 阳历的日期
     * @param $gua
     * @param array $extends
     * @param bool $watermark
     * @param bool $transparent
     * @throws InvalidArgumentException
     */
    private function __construct($date, $gua, $extends = [], $watermark = true, $transparent = false)
    {
        $this->calendar = app('calendar');
        $this->date = $date;
        $this->gua = $gua;
        $this->watermark = $watermark;
        $this->transparent = $transparent;

        if (!empty($extends)) {
            $this->question = $extends['question'] ?? '';
            $this->userName = $extends['userName'] ?? '';
            $this->trigramType = $extends['trigramType'] ?? '';
            $this->owner = $extends['owner'] ?? '';
        }

        $this->parseDate();
    }

    /**
     * A singleton pattern.
     *
     * @param date The date of birth of the person.
     * @param gua The gua number, which is the number of the hexagram.
     * @param extends
     * @param watermark Whether to add a watermark to the image.
     * @param transparent whether transparent
     * @return The instance of the class.
     */
    public static function getInstance($date, $gua, $extends = [], $watermark = true, $transparent = false)
    {
        if (static::$instance instanceof static) {
            return static::$instance;
        }

        static::$instance = new static($date, $gua, $extends, $watermark, $transparent);

        return static::$instance;
    }


    /**
     * > If the gua contains 3 or 4, it's available. If the gua doesn't exist in the totalGua array,
     * it's not available. If the gua's diZhi is in the day's cong, it's available. Otherwise, it's not
     * available
     */
    public function isAvailable()
    {
        if (strlen($this->gua) != 6) {
            throw new InvalidArgumentException('六爻卦参数不合法');
        }

        $tmp_arr = str_split($this->gua);
        foreach ($tmp_arr as $tmp_val) {
            if ($tmp_val < 1 || $tmp_val > 4) {
                throw new InvalidArgumentException('六爻卦参数不合法');
            }
        }

        if (Str::contains($this->gua, [3, 4])) {
            return true;
        }

        if (!Arr::exists($this->totalGua, $this->gua)) {
            return false;
        }

        $gua_dz = Arr::get($this->totalGua, $this->gua . '.di_zhi');
        $day_cong = $this->getCong($this->diZhiDay);

        if (Str::contains($gua_dz, $day_cong)) {
            return true;
        }

        return false;
    }

    /**
     * A function that returns the trigram picture.
     *
     * @param boolean draw Whether to draw the picture, the default is true
     *
     * @return array An array with the following keys:
     * - pic_url
     * - is_dangerous
     * - dangerous_note
     */
    public function getTrigramPic($draw = true)
    {
        $this->whiteDeath()
            ->deployDiZhi()
            ->handleWhiteDeath()
            ->getYaoDetail()
            ->handleDarkOn()
            ->handleRelationSixCong()
            ->handleRelationSixHe()
            ->handleRelationConvergeSet()
            ->handleEnterTomb()
            ->handleDilemma()
            ->handleVoltTrigram();

        if ($draw) {
            $pic_url = $this->draw();
        }

        return [
            'pic_url' => $pic_url ?? '',
            'is_dangerous' => $this->resultDiZhi['is_dangerous'] ?? false,
            'dangerous_note' => $this->resultDiZhi['dangerous_note'] ?? '',
        ];
    }


    /**
     * It takes in a god, a year, and two booleans, and returns an array of strings
     *
     * @param string god the god you want to get the fortune for
     * @param string year the year of the fortune
     * @param boolean is_pregnant Whether the person is pregnant or not.
     * @param boolean is_student if the person is a student, then the fortune will be different.
     *
     * @return array An array of the values of the variables.
     */
    public function fortune($god, $year, $is_pregnant = false, $is_student = false)
    {

        $god_positions = $this->getGodPositions($god);

        $this->setGodPositions($god_positions);


        $numen = $this->numen();

        $wealth = $this->wealth();

        $honourable_men = $this->honourableMen();

        $cause = $this->cause($is_student);

        $good_ill = $this->goodOrIll($god);

        $dissolve = $this->dissolve($year, $is_pregnant);

        $transform = $this->transform($god);

        $shield = $this->shield();

        $acc = $this->acc($god);

        return compact(
            'numen',
            'wealth',
            'honourable_men',
            'cause',
            'good_ill',
            'dissolve',
            'transform',
            'shield',
            'acc'
        );
    }


    /**
     * > The function is private, so it can't be called from outside the class. It's also a final
     * function, so it can't be overridden. It takes no arguments, and it doesn't return a value. It
     * also can't be called with the `parent` keyword from within a child class
     */
    private function __clone()
    {
    }

    public function bodyTrigram($god, $underageOrPregnant = false): array
    {
        $he = $this->bodyHe();

        $chong = $this->bodyChong();

        $ke = $this->bodyKe();

        $qi = $this->bodyEmptyDeathOrTomb();

        // 5、完成一部分
        $sha = $this->bodyKeInnerTrigram();

        $god_positions = $this->getGodPositions($god);
        $this->setGodPositions($god_positions);
        $unborn = '';
        if (!$underageOrPregnant) $unborn = $this->bodyUnborn($god);
        $ying = $this->bodyYing();
        // 第七项
        $graves = $this->bodyAncestralGraves($god_positions);
        // 第九项
        $used = $this->bodyGodResult();

        $energy = $this->mergeSimilar($sha, $ying);

        $result = compact('he', 'chong', 'ke', 'qi', 'unborn', 'graves', 'energy', 'used');

        //应罗师姐要求，身体卦结果最多出现4条
        $result = $this->getBodyLimitResult($result);

        return $this->replaceLastSymbol($result);
    }

    public function godTrigram(string $god): array
    {
        $god_positions = $this->getGodPositions($god);
        $this->setGodPositions($god_positions);
        return $this->replaceLastSymbol($this->getGodResultSet($god));
    }

    public function replaceLastSymbol(array $result): array
    {
        foreach ($result as $key => $value) {
            if (empty($value)) continue;
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if (substr($v, -3) == '，') $result[$key][$k] = Str::replaceLast('，', '。', $v);;
                }
            } else {
                if (substr($value, -3) == '，') $result[$key] =  Str::replaceLast('，', '。', $value);
            }
        }
        return $result;
    }

    protected function mergeSimilar($sha, $ying): string
    {
        //0-x
        if (empty($ying['str'])) {
            return $sha['str'];
        }

        //x-0
        if (empty($sha['str'])) {
            return $ying['str'];
        }

        /**ying
         *   $str1 = '住家门口磁场有扬升空间，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
         *   $str2 = '家门口能量场有扬升空间，有受到外部?方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
         *   $str3 = '有受到外部?方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
         *
         *ke
            有受到西北方五黄煞能量影响，建议择日化解家中五黄煞对我家运有助。卜卦问句为：何日化解家中五黄煞对我家运有助？
            有受到' . $row['direction'] . '方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？
            有受到' . $row['direction'] . '方位的动土能量影响，及西北方五黄煞能量影响，建议择日净化家中磁场及化解家中五黄煞对我家运有助。卜卦问句为：何日净化家中磁场及化解家中五黄煞对我家运有助
         */

        $default = '建议择日净化家中磁场及化解家中五黄煞对我家运有助。卜卦问句为：何日净化家中磁场及化解家中五黄煞对我家运有助？';

        //1-1 1-2 1-3
        if ($ying['key'] == 1 && $sha['key'] == 1) {
            return '住家门口磁场有扬升空间,有受到西北方五黄煞能量影响,' . $default;
        }

        if ($ying['key'] == 1 && $sha['key'] == 2) {
            return '住家门口磁场有扬升空间，' . $sha['str'];
        }

        if ($ying['key'] == 1 && $sha['key'] == 3) {
            return '住家门口磁场有扬升空间，' . $sha['str'];
        }

        //2-1 2-2 2-3
        if ($ying['key'] == 2 && $sha['key'] == 1) {
            return '家门口能量场有扬升空间，有受到外部' . $ying['direction'] . '方位的动土能量影响，' . '及西北方五黄煞能量影响，' . $default;
        }

        if ($ying['key'] == 2 && $sha['key'] == 2) {
            return '家门口能量场有扬升空间，' . '有受到' . implode('，', array_unique($ying['direction'], $sha['direction'])) . '方位的动土能量影响，建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
        }

        if ($ying['key'] == 2 && $sha['key'] == 3) {
            return '家门口能量场有扬升空间，' . '有受到' . implode('，', array_unique($ying['direction'], $sha['direction'])) . '方位的动土能量影响，' . $default;
        }

        //3-1 3-2 3-3
        if ($ying['key'] == 3 && $sha['key'] == 1) {
            return '有受到外部' . $ying['direction'] . '方位的动土能量影响，' . '及西北方五黄煞能量影响，' . $default;
        }

        if ($ying['key'] == 3 && $sha['key'] == 2) {
            return '有受到' . implode('，', array_unique($ying['direction'], $sha['direction'])) . '方位的动土能量影响，' . '建议您择日净化住家磁场有助家运。卜卦问句：何日净化家中磁场对我家运有助？';
        }

        if ($ying['key'] == 3 && $sha['key'] == 3) {
            return '有受到' . implode('，', array_unique($ying['direction'], $sha['direction'])) . '方位的动土能量影响，' . '及西北方五黄煞能量影响，' . $default;
        }

        return '';
    }

    protected function getBodyLimitResult($result, $limit = 4)
    {
        $data = [];
        if (!empty($result['energy'])) {
            $data[] = $result['energy'];
        }
        if (!empty($result['used'])) {
            $data[] = $result['used'];
        }

        unset($result['energy'], $result['used']);

        $result = array_filter(array_values($result));

        $offset = $limit - count($data);

        if ($offset >= count($result)) {
            return array_merge($result, $data);
        }

        $random_keys = array_rand($result, $offset);
        foreach ($random_keys as $key) {
            array_unshift($data, $result[$key]);
        }

        return $data;
    }
}
