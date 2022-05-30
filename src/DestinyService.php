<?php

namespace Maturest\Trigram;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maturest\Trigram\Exceptions\InvalidArgumentException;
use Maturest\Trigram\Traits\Destiny\BuDiZhiTrait;
use Maturest\Trigram\Traits\Destiny\ConvergeSetTrait;
use Maturest\Trigram\Traits\Destiny\DilemmaTrait;
use Maturest\Trigram\Traits\Destiny\DrawTrait;
use Maturest\Trigram\Traits\Destiny\EnterTombTrait;
use Maturest\Trigram\Traits\Destiny\SixCongTrait;
use Maturest\Trigram\Traits\Destiny\SixHeTrait;
use Maturest\Trigram\Traits\Destiny\VoltTrigramTrait;
use Maturest\Trigram\Traits\Destiny\WhiteDeathTrait;

class DestinyService
{
    use BuDiZhiTrait, WhiteDeathTrait, SixCongTrait, SixHeTrait, ConvergeSetTrait,
        EnterTombTrait, DilemmaTrait, VoltTrigramTrait, DrawTrait;

    private static $instance;

    public $draw = [
        'kong_wang' => ['coords' => [], 'radius' => 20], // 标空亡,给出具体的坐标原点，半径,文字图片是40x40 半径应为20 ，然后画圆
        'an_dong' => ['coords' => [], 'img' => 'dark_on/dark_on.png'], // 暗动，标注坐标原点,然后画箭头并写字 字体的坐标可以相对计算
        'six_chong' => [],//六冲
        'six_he' => [], //六合
        'hui_ju' => [],//汇局
        'ru_mu' => [],//入墓
        'jin_tui' => [],//进退神
        'fu_yao' => [],//伏爻
    ];

    protected $calendar;

    // \ => 1 \\ => 2  o => 3  x => 4 123412 从左至右按顺序解释为：一爻 二爻 --- 六爻
    protected $gua;

    //用户问句
    protected $question;

    //用户姓名
    protected $userName;

    //卜卦类型
    protected $trigramType;

    //服务归属人
    protected $owner;

    //是否需要水印
    protected $watermark;

    /**
     * DestinyService constructor.
     * @param $date 1996-01-01 05:26:38 阳历的日期
     * @param $gua
     * @param array $extends
     * @throws InvalidArgumentException
     */
    private function __construct($date, $gua, $extends = [], $watermark = true)
    {
        $this->calendar = app('calendar');
        $this->date = $date;
        $this->gua = $gua;
        $this->watermark = $watermark;

        if (!empty($extends)) {
            $this->question = $extends['question'] ?? '';
            $this->userName = $extends['userName'] ?? '';
            $this->trigramType = $extends['trigramType'] ?? '';
            $this->owner = $extends['owner'] ?? '';
        }

        $this->parseDate();
    }

    public static function getInstance($date, $gua, $extends = [], $watermark = true)
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        self::$instance = new self($date, $gua, $extends);
        return self::$instance;
    }

    /**
     * 检测是否显卦
     * 不显卦：纯净爻并且没有与日令存在六冲的
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

        // 为了安全考虑 查看是否是64卦中的一种
        if (!Arr::exists($this->totalGua, $this->gua)) {
            return false;
        }

        // 看卦的十二地支 与当天的日令是否存在对冲关系，如果不存在对冲的话就不现卦
        $gua_dz = Arr::get($this->totalGua, $this->gua . '.di_zhi');
        $day_cong = $this->getCong($this->diZhiDay);

        if (Str::contains($gua_dz, $day_cong)) {
            return true;
        }

        return false;
    }

    public function getTrigramPic()
    {
        $pic_url = $this->whiteDeath()
            ->deployDiZhi()
            ->handleWhiteDeath()
            ->getYaoDetail()
            ->handleDarkOn()
            ->handleRelationSixCong()
            ->handleRelationSixHe()
            ->handleRelationConvergeSet()
            ->handleEnterTomb()
            ->handleDilemma()
            ->handleVoltTrigram()
            ->draw();

        return [
            'pic_url' => $pic_url,
            'is_dangerous' => $this->resultDiZhi['is_dangerous'] ?? false,
            'dangerous_note' => $this->resultDiZhi['dangerous_note'] ?? '',
        ];
    }

    /**
     * 私有化克隆方法
     */
    private function __clone()
    {

    }
}
