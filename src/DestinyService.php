<?php

namespace Maturest\Trigram;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maturest\Trigram\Exceptions\InvalidArgumentException;
use Maturest\Trigram\Traits\DestinyTrait;
use Maturest\Trigram\Traits\FortuneTrait;
use Maturest\Trigram\Traits\BodyTrigramTrait;

class DestinyService
{
    use DestinyTrait, FortuneTrait, BodyTrigramTrait;

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

    /**
     * Body Trigram
     *
     * @return void
     */
    public function bodyTrigram($god, $underageOrPregnant = false)
    {
        $he = $this->bodyHe();

        $chong = $this->bodyChong();

        $ke = $this->bodyKe();

        $qi = $this->bodyEmptyDeathOrTomb();

        $sha = $this->bodyKeInnerTrigram();

        $god_positions = $this->getGodPositions($god);
        $this->setGodPositions($god_positions);

        $unborn = '';
        if (!$underageOrPregnant) {
            $unborn = $this->bodyUnborn($god);
        }

        return compact('he', 'chong', 'ke', 'qi', 'sha', 'unborn');
    }
}
