<?php


namespace Maturest\Trigram\Traits\Destiny;


use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maturest\Trigram\Exceptions\ImagesNotFoundException;

trait DrawTrait
{

    protected $relativePath = '64draw/basis/';

    protected $fontToImg = [
        ['font' => '子', 'img' => 'fonts/zi.png'],
        ['font' => '丑', 'img' => 'fonts/chou.png'],
        ['font' => '寅', 'img' => 'fonts/yin.png'],
        ['font' => '卯', 'img' => 'fonts/mao.png'],
        ['font' => '辰', 'img' => 'fonts/chen.png'],
        ['font' => '巳', 'img' => 'fonts/si.png'],
        ['font' => '午', 'img' => 'fonts/wu.png'],
        ['font' => '未', 'img' => 'fonts/wei.png'],
        ['font' => '申', 'img' => 'fonts/shen.png'],
        ['font' => '酉', 'img' => 'fonts/you.png'],
        ['font' => '戌', 'img' => 'fonts/xu.png'],
        ['font' => '亥', 'img' => 'fonts/hai.png'],
        ['font' => '世', 'img' => 'fonts/shi.png'],
        ['font' => '应', 'img' => 'fonts/ying.png'],
        ['font' => '月', 'img' => 'fonts/yue.png'],
        ['font' => '日', 'img' => 'fonts/ri.png'],
        ['font' => '甲', 'img' => 'fonts/jia.png'],
        ['font' => '乙', 'img' => 'fonts/yi.png'],
        ['font' => '丙', 'img' => 'fonts/bing.png'],
        ['font' => '丁', 'img' => 'fonts/ding.png'],
        ['font' => '戊', 'img' => 'fonts/wwu.png'],
        ['font' => '己', 'img' => 'fonts/ji.png'],
        ['font' => '庚', 'img' => 'fonts/geng.png'],
        ['font' => '辛', 'img' => 'fonts/xin.png'],
        ['font' => '壬', 'img' => 'fonts/ren.png'],
        ['font' => '癸', 'img' => 'fonts/kui.png'],
        ['font' => '汇兄局', 'img' => 'fonts/.png'],
        ['font' => '汇兄局破', 'img' => 'fonts/.png'],
        ['font' => '汇子局', 'img' => 'fonts/.png'],
        ['font' => '汇子局破', 'img' => 'fonts/.png'],
        ['font' => '汇父局', 'img' => 'fonts/.png'],
        ['font' => '汇父局破', 'img' => 'fonts/.png'],
        ['font' => '汇财局', 'img' => 'fonts/.png'],
        ['font' => '汇财局破', 'img' => 'fonts/.png'],
        ['font' => '汇官局', 'img' => 'fonts/.png'],
        ['font' => '汇官局破', 'img' => 'fonts/.png'],
        ['font' => '1', 'img' => 'fonts/_.png'],
        ['font' => '2', 'img' => 'fonts/__.png'],
        ['font' => '3', 'img' => 'fonts/o.png'],
        ['font' => '4', 'img' => 'fonts/X.png'],
        ['font' => '-', 'img' => 'fonts/hr.png'],
        ['font' => '兄', 'img' => 'fonts/xiong.png'],
        ['font' => '父', 'img' => 'fonts/fu.png'],
        ['font' => '官', 'img' => 'fonts/guan.png'],
        ['font' => '财', 'img' => 'fonts/cai.png'],
        ['font' => 'x', 'img' => 'fonts/X.png']
    ];

    //默认字体颜色
    protected $fontColor = '#333333';

    //卦变字体颜色
    protected $gbFontColor;

    protected $bgObject;

    /**
     * 画图，返回的应该是一张图片路径
     */
    public function draw()
    {
        //初始化画布
        $this->initBgObject();
        //是否添加水印
        $this->addWaterMark();
        //1、部地支
        $this->drawDiZhi();
        //1.2 添加问句和姓名
        $this->drawQuestionsAndName();
        //2、标空亡
        $this->drawWhiteDeath();
        //3、暗动
        $this->drawDarkOn();
        //4、六冲
        $this->drawSixChong();
        //5、六合
        $this->drawSixHe();
        //6、汇局
        $this->drawJoin();
        //7、入墓
        $this->drawEnterTomb();
        //8、进退神
        $this->drawDilemma();
        //9、伏爻
        $this->drawVoltTrigram();


        $filename = app()->isLocal() ? 'test.png' : date('YmdHis') . Str::random(10) . '.png';
        $file_path = '64draw/trigrams/' . $filename;
        $this->bgObject->save(public_path($file_path));
        return config('app.url') . DIRECTORY_SEPARATOR . $file_path;
    }

    public function initBgObject()
    {
        $drawBg = public_path($this->relativePath . 'bg.png');
        $this->fileExists($drawBg);
        $this->bgObject = Image::make($drawBg);
    }

    public function fileExists($file)
    {
        if (!file_exists($file)) {
            throw new ImagesNotFoundException($file . '文件未找到');
        }
    }

    public function addWaterMark()
    {
        if ($this->watermark) {
            $watermark = public_path($this->relativePath . 'watermark.png');
            $this->fileExists($watermark);
            $this->bgObject->insert($watermark, 'top-left', 77, 15);
        }
    }

    public function drawDiZhi()
    {
        //1、画本卦字体
        $this->writeBenGuaFont();
        //2、画日期
        $this->writeDate();
        //3、写关系 世应 本爻 本爻字体 化爻
        $this->writeBenGua();
        //4、日令 月令 空亡
        $this->writeDateLing();
    }

    /**
     * 写本卦以及卦变
     */
    public function writeBenGuaFont()
    {
        $ben_gua = $this->resultDiZhi['ben_gua'];
        $this->writeFont($ben_gua, 39, 37);

        if ($this->isGuaBian()) {
            $font = '卦变：' . $this->resultDiZhi['gua_bian'];
            $this->writeFont($font, 39, 80, 30, '#d93615');
        }

    }

    /**
     * 在图像资源上写字
     * @param $font
     * @param $x
     * @param $y
     * @param $size
     * @param $color
     */
    public function writeFont($font, $x, $y, $size = 30, $color = '')
    {
        if (empty($color)) {
            $color = $this->fontColor;
        }
        $this->bgObject->text($font, $x, $y, function ($font) use ($size, $color) {
            $font->file($this->getHanFont());
            $font->size($size);
            $font->color($color);
            $font->align('left');
            $font->valign('top');
        });
    }

    public function getHanFont()
    {
        $font_path = public_path('fonts/msyh.ttf');
        $this->fileExists($font_path);
        return $font_path;
    }

    public function isGuaBian()
    {
        return isset($this->resultDiZhi['gua_bian']) && $this->resultDiZhi['gua_bian'];
    }

    /**
     * 写本卦日期
     */
    public function writeDate()
    {
        // 写年月
        $date = Carbon::parse($this->date)->format('m月d日');
        $this->writeFont($date, 491, 38);

        // 写时间
        $time = Carbon::parse($this->date)->format('H时i分s秒');
        $this->writeFont($time, 491, 80, 20);
    }

    /**
     * 鬼画符
     */
    public function writeBenGua()
    {
        //六亲
        $liu_qin = $this->getSixQinPosition();
        //世应
        $shi_ying = $this->getShiYingPosition();
        //六爻
        $yao = $this->getAllBenYaoPositions();
        //本卦
        $ben = $this->getPositionsInlineBen();
        //化爻的横线
        $trans_hr = $this->getTransHrPositions();
        //化爻
        $trans = $this->getAllHuaPositions();

        //汇总到一起
        $arr = array_merge($liu_qin, $shi_ying, $yao, $ben, $trans_hr, $trans);
        foreach ($arr as $value) {
            $this->insertImg($value);
        }
    }

    /**
     * 获取六亲的位置
     * @return array
     */
    public function getSixQinPosition()
    {
        $arr = explode(',', $this->resultDiZhi['liu_qin']);
        return $this->transToArr($arr, 1);
    }

    /**
     * 将某列的卦转为数组
     * @param $arr
     * @param $column
     * @return array
     */
    public function transToArr($arr, $column)
    {
        $res = [];
        foreach ($arr as $key => $value) {
            if ($value) {
                $res[] = [
                    'dz' => $column == 7 ? '-' : $value,
                    'column' => $column,
                    'row' => (6 - intval($key)),
                ];
            }
        }
        return $res;
    }

    /**
     * 获取世应的位置
     * @return array
     */
    public function getShiYingPosition()
    {
        $arr = explode(',', $this->resultDiZhi['shi_ying']);
        return $this->transToArr($arr, 2);
    }

    /**
     * 获取所有本爻的位置
     * @return array
     */
    public function getAllBenYaoPositions()
    {
        $arr = str_split($this->gua);
        return $this->transToArr($arr, 3);
    }

    public function getTransHrPositions()
    {
        $res = [];
        if ($this->transGuaExists()) {
            $arr = explode(',', $this->resultDiZhi['trans_di_zhi']);
            $res = $this->transToArr($arr, 7);
        }
        return $res;
    }

    public function insertImg($position)
    {
        $font = $position['dz'];
        $row = collect($this->fontToImg)->where('font', $font)->first();
        $img = public_path($this->relativePath . $row['img']);

        $this->fileExists($img);

        $xy = $position['column'] . $position['row'];
        $xy = collect($this->dotCoords)->where('position', $xy)->first();
        $x = Arr::get($xy, 'x');
        $y = Arr::get($xy, 'y');


        $this->bgObject->insert($img, 'top-left', $x, $y);
    }

    public function writeDateLing()
    {
        //先把定空亡的两个括号给画了
        $this->writeFont('︻', '590', '613', 36);
        $this->writeFont('︼', '590', '790', 36);

        $fonts = [
            ['font' => $this->gzMonth, 'position' => '61', 'distance' => 52],
            ['font' => $this->gzDay, 'position' => '62', 'distance' => 52],
            ['font' => 'x' . $this->kongWang, 'position' => '63', 'distance' => 50],
        ];

        foreach ($fonts as $font) {
            $this->writeDateLingFont($font['font'], $font['position'], $font['distance']);
        }
    }

    public function writeDateLingFont($date_font, $position, $h)
    {
        $arr = mb_str_split($date_font);

        $row = collect($this->dotCoords)->where('position', $position)->first();

        foreach ($arr as $key => $font) {
            $x = $row['x'];
            $y = $row['y'] + $key * $h;
            if ($font == 'x') {
                $x += 2;
            }
            $img = collect($this->fontToImg)->where('font', $font)->first();
            $img = public_path($this->relativePath . $img['img']);
            $this->fileExists($img);
            $this->bgObject->insert($img, 'top-left', $x, $y);
        }
    }

    public function drawQuestionsAndName()
    {
        if ($this->question || $this->trigramType) {
            //1、先画个圆圈，然后写个占字
            $this->bgObject->circle(20, 570, 180, function ($draw) {
                $draw->background('#7a7a7a');
                $draw->border(1, '#7a7a7a');
            });

            $this->writeFont('占', 565, 175, 12, '#FFFFFF');
        }

        if ($this->question || $this->trigramType) {

            //2、将卜卦类型与问句结合，然后最多拆分为两列
            $str = $this->trigramType ? $this->trigramType . ' ' . $this->question : $this->question;
            $fonts = array_chunk(mb_str_split($str), 33);
            $size = 14;
            $color = '#666666';
            $x = 572;
            foreach ($fonts as $key => $items) {
                $x = $x - 22 * $key;
                $y = 210;
                foreach ($items as $item) {
                    $this->writeFrontVerticalAlignCenter($item, $x, $y, $size, $color);
                    $y += 18;
                }
            }

        }

        if ($this->userName) {
            //3、写入名字
            $fonts = mb_str_split($this->userName);
            $size = 24;
            $color = '#000000';
            $x = 610;
            $y = 830;
            foreach ($fonts as $item) {
                $this->writeFrontVerticalAlignCenter($item, $x, $y, $size, $color);
                $y += 26;
            }
        }

        //4、写上归属人
        if ($this->owner) {
            $str = '归属人：' . $this->owner;
            $this->writeFont($str, 167, 846, 24, '#999999');
        }
    }

    public function writeFrontVerticalAlignCenter($font, $x, $y, $size = 30, $color = '')
    {
        if (empty($color)) {
            $color = $this->fontColor;
        }
        $this->bgObject->text($font, $x, $y, function ($font) use ($size, $color) {
            $font->file($this->getHanFont());
            $font->size($size);
            $font->color($color);
            $font->align('center');
            $font->valign('center');
        });
    }

    /**
     * 标空亡 再远点画圈圈
     * @return bool
     */
    public function drawWhiteDeath()
    {
        $coords = $this->draw['kong_wang']['coords'] ?? [];
        if (empty($coords)) {
            return false;
        }

        $radius = $this->draw['kong_wang']['radius'];
        foreach ($coords as $coord) {
            $x = $coord['x'] + $radius;
            $y = $coord['y'] + $radius;

            $this->bgObject->circle(50, $x, $y, function ($draw) {
                $draw->border(1, '#da4225');
            });
        }

        return true;
    }

    /**
     * 标明暗动
     * @return bool
     */
    public function drawDarkOn()
    {
        $coords = $this->draw['an_dong']['coords'] ?? [];

        if (empty($coords)) {
            return false;
        }

        $img = public_path($this->relativePath . $this->draw['an_dong']['img']);
        $this->fileExists($img);

        foreach ($coords as $coord) {
            $row = collect($this->dotCoords)->where('position', $coord)->first();
            $this->bgObject->insert($img, 'top-left', $row['x'], $row['y']);
        }

        return true;
    }

    /**
     * 画六冲关系
     * @return bool
     */
    public function drawSixChong()
    {
        $six_chongs = $this->draw['six_chong'] ?? [];
        if (empty($six_chongs)) {
            return false;
        }

        foreach ($six_chongs as $six_chong) {
            $row = $this->sixCongImages[$six_chong];
            $this->drawArrow($row, $six_chong);
        }

        return true;
    }

    /**
     * @param $row
     * @param $item
     */
    public function drawArrow($row, $item)
    {
        // 画箭头
        $img = public_path($this->relativePath . $row['img']);
        $this->fileExists($img);
        $this->bgObject->insert($img, 'top-left', $row['left_top'][0], $row['left_top'][1]);

        if (in_array($item, ['41-51', '42-52', '43-53', '44-54', '45-55', '46-56'])) {
            // 画中间的字
            $this->writeFont($row['font'], $row['middle'][0], $row['middle'][1], 16, '#D93615');
        } else {
            // 画中间合
            $img = public_path($this->relativePath . $row['mid_img']);
            $this->fileExists($img);
            $this->bgObject->insert($img, 'top-left', $row['middle'][0], $row['middle'][1]);
        }
    }

    /**
     * 画六合关系
     * @return bool
     */
    public function drawSixHe()
    {
        $six_hes = $this->draw['six_he'] ?? [];
        if (empty($six_hes)) {
            return false;
        }

        foreach ($six_hes as $six_he) {
            $row = $this->sixHeImages[$six_he];
            $this->drawArrow($row, $six_he);
        }

        return true;
    }

    /**
     * 处理汇局
     */
    public function drawJoin()
    {
        //1、处理上汇局
        $up = $this->draw['hui_ju']['up'] ?? [];
        if (!empty($up)) {
            $this->huiJuUp($up);
        }

        //2、处理下汇局
        $down = $this->draw['hui_ju']['down'] ?? [];
        if (!empty($down)) {
            $this->huiJuDown($down);
        }

        return true;
    }

    /**
     * 处理下卦汇局
     * @param $up
     */
    public function huiJuUp($up)
    {
        //1、画花括号
        $this->drawBracket(46, 147);

        $x = 29;
        $y = 231;
        $gap = 18;
        //2、画汇局
        $this->huiJu($up, $x, $y, $gap);
    }

    /**
     * 画花括号
     * @param $x
     * @param $y
     */
    public function drawBracket($x, $y)
    {
        $bracket = public_path($this->relativePath . 'hui_ju/bracket.png');
        $this->fileExists($bracket);
        $this->bgObject->insert($bracket, 'top-left', $x, $y);
    }

    /**
     * 画汇局
     * @param $hui_ju
     * @param $x
     * @param $y
     * @param $gap
     */
    public function huiJu($hui_ju, $x, $y, $gap)
    {
        foreach ($hui_ju as $key => $item) {
            $row = collect($this->joinImages)->where('hui_ju', $item['hui_ju'])
                ->where('torn', $item['torn'])->first();
            $img = public_path($this->relativePath . $row['img']);
            $this->fileExists($img);
            $x = $x - $key * $gap;
            $this->bgObject->insert($img, 'top-left', $x, $y);
        }
    }

    /**
     * 处理上卦汇局
     * @param $down
     */
    public function huiJuDown($down)
    {
        //1、画花括号
        $this->drawBracket(46, 536);

        $x = 29;
        $y = 620;
        $gap = 18;
        //2、画汇局
        $this->huiJu($down, $x, $y, $gap);
    }

    public function drawEnterTomb()
    {
        $ru_mus = $this->draw['ru_mu'] ?? [];
        if (empty($ru_mus)) {
            return false;
        }

        foreach ($ru_mus as $ru_mu) {
            $row = $this->ruMuImages[$ru_mu];
            $this->drawArrow($row, $ru_mu);
        }

        return true;
    }

    public function drawDilemma()
    {
        $dilemmas = $this->draw['jin_tui'] ?? [];
        if (empty($dilemmas)) {
            return false;
        }

        foreach ($dilemmas as $dilemma) {

            $row = $this->dilemmaPositions[$dilemma['position']];
            // 画箭头
            $img = public_path($this->relativePath . $row['img']);
            $this->fileExists($img);
            $this->bgObject->insert($img, 'top-left', $row['left_top'][0], $row['left_top'][1]);

            //写字
            $this->writeFont($dilemma['font'], $row['middle'][0], $row['middle'][1], 16, '#D93615');

        }
        return true;
    }

    public function drawVoltTrigram()
    {
        $fu_yaos = $this->draw['fu_yao'] ?? [];
        if (empty($fu_yaos)) {
            return false;
        }

        foreach ($fu_yaos as $fu_yao) {
            $position = $this->voltTrigramPositions[$fu_yao['position']];
            $this->writeFont($fu_yao['fu_yao'], $position['x'], $position['y'], 22, '#D93615');
        }
    }

    /**
     * 通过位置写字
     */
    public function writeFontByPosition($position)
    {
        $font = $position['dz'];
        $xy = $position['column'] . $position['row'];
        $xy = collect($this->dotCoords)->where('position', $xy)->first();
        $x = Arr::get($xy, 'x');
        $y = Arr::get($xy, 'y');

        $this->writeFont($font, $x, $y, 38);
    }

    /**
     * 通过卦象转换为卦符
     * @param $item
     * @return string
     */
    public function getSymbol($item)
    {
        switch ($item) {
            case 1:
                return '/';
            case 2:
                return '//';
            case 3:
                return 'o';
            case 4:
                return 'x';
        }
        return 'x';
    }
}
