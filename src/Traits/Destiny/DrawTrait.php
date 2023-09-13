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

    protected $fontColor = '#333333';

    protected $gbFontColor;

    protected $bgObject;


    /**
     * > The function draws the trigram image and returns the image url
     *
     * @return A string of the file path.
     */
    public function draw()
    {
        $this->initBgObject();

        $this->addWaterMark();

        $this->drawDiZhi();

        $this->drawQuestionsAndName();

        $this->drawWhiteDeath();

        $this->drawDarkOn();

        $this->drawSixChong();

        $this->drawSixHe();

        $this->drawJoin();

        $this->drawEnterTomb();

        $this->drawDilemma();

        $this->drawVoltTrigram();

        $filename = app()->isLocal() ? 'test.png' : date('YmdHis') . Str::random(10) . '.png';
        $file_path = '64draw/trigrams/' . $filename;
        $this->bgObject->save(public_path($file_path));
        return config('app.url') . DIRECTORY_SEPARATOR . $file_path;
    }

    /**
     * It creates a new image object from the file bg.png
     */
    public function initBgObject()
    {
        $image = public_path($this->relativePath . 'bg.png');
        $this->fileExists($image);

        if ($this->transparent) {
            $image = imagecreatetruecolor(690, 1010);
            imagesavealpha($image, true);
            $transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
            imagefill($image, 0, 0, $transparentColor);
        }

        $this->bgObject = Image::make($image);

        if ($this->transparent) {
            $this->drawHorizontalLine();
        }
    }

    public function drawHorizontalLine()
    {
        for ($i = 166; $i < 486; $i++) {
            $this->bgObject->pixel('#333333', $i, 467);
        }
    }

    /**
     * > This function checks if a file exists. If it doesn't, it throws an exception
     *
     * @param file The file path to be processed
     */
    public function fileExists($file)
    {
        if (!file_exists($file)) {
            throw new ImagesNotFoundException($file . '文件未找到');
        }
    }

    /**
     * It takes the background image, and inserts the watermark image into the top left corner of the
     * background image
     */
    public function addWaterMark()
    {
        if ($this->watermark) {
            $watermark = public_path($this->relativePath . 'watermark.png');
            $this->fileExists($watermark);
            $this->bgObject->insert($watermark, 'top-left', 77, 15);
        }
    }

    /**
     * It writes the date, the ben gua, and the date ling to the image
     */
    public function drawDiZhi()
    {
        $this->writeBenGuaFont();
        $this->writeDate();
        $this->writeBenGua();
        $this->writeDateLing();
    }


    /**
     * It writes the ben_gua to the image.
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
     * It writes a font to the image.
     *
     * @param font The text to be written
     * @param x The x coordinate of the text
     * @param y The y coordinate of the text
     * @param size font size
     * @param color The color of the font, in RGB format.
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

    /**
     * It returns the path of the font file.
     *
     * @return The path to the font file.
     */
    public function getHanFont()
    {
        $font_path = public_path('fonts/msyh.ttf');
        $this->fileExists($font_path);
        return $font_path;
    }

    /**
     * It checks if the resultDiZhi array has a key called 'gua_bian' and if it does, it checks if the
     * value is true.
     */
    public function isGuaBian()
    {
        return isset($this->resultDiZhi['gua_bian']) && $this->resultDiZhi['gua_bian'];
    }


    /**
     * It writes the date and time to the image.
     */
    public function writeDate()
    {
        $date = Carbon::parse($this->date)->format('m月d日');
        $this->writeFont($date, 491, 38);

        $time = Carbon::parse($this->date)->format('H时i分s秒');
        $this->writeFont($time, 491, 80, 20);
    }


    /**
     * It inserts images into the HTML document
     */
    public function writeBenGua()
    {
        $liu_qin = $this->getSixQinPosition();

        $shi_ying = $this->getShiYingPosition();

        $yao = $this->getAllBenYaoPositions();

        $ben = $this->getPositionsInlineBen();

        $trans_hr = $this->getTransHrPositions();

        $trans = $this->getAllHuaPositions();

        $arr = array_merge($liu_qin, $shi_ying, $yao, $ben, $trans_hr, $trans);
        foreach ($arr as $value) {
            $this->insertImg($value);
        }
    }


    /**
     * It returns the position of the six qin.
     */
    public function getSixQinPosition()
    {
        $arr = explode(',', $this->resultDiZhi['liu_qin']);
        return $this->transToArr($arr, 1);
    }


    /**
     * It takes an array of strings, and a column number, and returns an array of arrays, each of which
     * has a 'dz', 'column', and 'row' key
     *
     * @param arr the array to be converted
     * @param column the column number of the chessboard, from left to right, starting from 0
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
     * It takes a string of numbers separated by commas, and returns an array of arrays of two numbers
     * each
     */
    public function getShiYingPosition()
    {
        $arr = explode(',', $this->resultDiZhi['shi_ying']);
        return $this->transToArr($arr, 2);
    }


    /**
     * It returns an array of the positions of the ben yao.
     *
     * @return The positions of the Ben Yao.
     */
    public function getAllBenYaoPositions()
    {
        $arr = str_split($this->gua);
        return $this->transToArr($arr, 3);
    }

    /**
     * It takes the `trans_di_zhi` value from the `result_di_zhi` table, splits it into an array, and
     * then returns the 7th element of that array
     */
    public function getTransHrPositions()
    {
        $res = [];
        if ($this->transGuaExists()) {
            $arr = explode(',', $this->resultDiZhi['trans_di_zhi']);
            $res = $this->transToArr($arr, 7);
        }
        return $res;
    }

    /**
     * It takes a position, finds the corresponding image, and inserts it into the background image at
     * the correct coordinates
     *
     * @param position the position of the image to be inserted
     */
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

    /**
     * It writes the date on the image.
     */
    public function writeDateLing()
    {
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

    /**
     * It takes a string, splits it into an array, then loops through the array and inserts the
     * corresponding image into the background image
     *
     * @param date_font the date you want to write
     * @param position the position of the date in the image.
     * @param h the height of the font
     */
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

    /**
     * It draws the question and the name of the user.
     */
    public function drawQuestionsAndName()
    {
        if ($this->question || $this->trigramType) {
            $this->bgObject->circle(20, 570, 180, function ($draw) {
                $draw->background('#7a7a7a');
                $draw->border(1, '#7a7a7a');
            });

            $this->writeFont('占', 565, 175, 12, '#FFFFFF');
        }

        if ($this->question || $this->trigramType) {
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

        if ($this->owner) {
            $str = '归属人：' . $this->owner;
            $this->writeFont($str, 167, 846, 24, '#999999');
        }
    }

    /**
     * It writes the text in the center of the image.
     *
     * @param font The text to be written
     * @param x The x coordinate of the text
     * @param y The y-coordinate of the text
     * @param size font size
     * @param color The color of the text.
     */
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
     * Draw a red circle around the coordinates of the white death
     *
     * @return the value of the last expression in the function.
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
     * > Draws the dark on image on the background image
     *
     * @return the boolean value of true.
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
     * > Draws arrows on the image to indicate the six chong
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
     * It takes a row from a CSV file, and draws an arrow on the image
     *
     * @param row the row of the array in the config file
     * @param item The item number
     */
    public function drawArrow($row, $item)
    {
        $img = public_path($this->relativePath . $row['img']);
        $this->fileExists($img);
        $this->bgObject->insert($img, 'top-left', $row['left_top'][0], $row['left_top'][1]);

        if (in_array($item, ['41-51', '42-52', '43-53', '44-54', '45-55', '46-56'])) {
            $this->writeFont($row['font'], $row['middle'][0], $row['middle'][1], 16, '#D93615');
        } else {
            $img = public_path($this->relativePath . $row['mid_img']);
            $this->fileExists($img);
            $this->bgObject->insert($img, 'top-left', $row['middle'][0], $row['middle'][1]);
        }
    }


    /**
     * > Draws the six he images and arrows
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
     * It draws the join of the table.
     */
    public function drawJoin()
    {
        $up = $this->draw['hui_ju']['up'] ?? [];
        if (!empty($up)) {
            $this->huiJuUp($up);
        }

        $down = $this->draw['hui_ju']['down'] ?? [];
        if (!empty($down)) {
            $this->huiJuDown($down);
        }

        return true;
    }


    /**
     * It draws the bracket for the huiJuUp function.
     *
     * @param up the number of the round you want to draw
     */
    public function huiJuUp($up)
    {
        $this->drawBracket(46, 147);
        $x = 29;
        $y = 231;
        $gap = 18;
        $this->huiJu($up, $x, $y, $gap);
    }


    /**
     * It draws a bracket on the image.
     *
     * @param x The x-coordinate of the top-left corner of the image.
     * @param y The y coordinate of the top left corner of the image.
     */
    public function drawBracket($x, $y)
    {
        $bracket = public_path($this->relativePath . 'hui_ju/bracket.png');
        $this->fileExists($bracket);
        $this->bgObject->insert($bracket, 'top-left', $x, $y);
    }


    /**
     * It takes an array of images and places them on the background image.
     *
     * @param hui_ju The array of the data to be joined
     * @param x The x-coordinate of the top left corner of the image.
     * @param y The y-axis of the image
     * @param gap the distance between the two images
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
     * It draws the bracket for the down vote.
     *
     * @param down the number of down
     */
    public function huiJuDown($down)
    {
        $this->drawBracket(46, 536);
        $x = 29;
        $y = 620;
        $gap = 18;
        $this->huiJu($down, $x, $y, $gap);
    }

    /**
     * > Draws an arrow from the tomb to the tomb's corresponding mu
     */
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

    /**
     * > It draws the dilemma image and text on the background image
     */
    public function drawDilemma()
    {
        $dilemmas = $this->draw['jin_tui'] ?? [];
        if (empty($dilemmas)) {
            return false;
        }

        foreach ($dilemmas as $dilemma) {
            $row = $this->dilemmaPositions[$dilemma['position']];
            $img = public_path($this->relativePath . $row['img']);
            $this->fileExists($img);
            $this->bgObject->insert($img, 'top-left', $row['left_top'][0], $row['left_top'][1]);
            $this->writeFont($dilemma['font'], $row['middle'][0], $row['middle'][1], 16, '#D93615');
        }
        return true;
    }

    /**
     * > Draw the trigram of the hexagram
     *
     * @return the value of the variable .
     */
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
     * > Write the font at the position
     *
     * @param position the position of the font in the grid
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
     * > It returns a symbol based on the value of the parameter
     *
     * @param item The item number.
     *
     * @return The symbol for the item.
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
