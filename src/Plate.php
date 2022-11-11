<?php


namespace Maturest\Trigram;

use Maturest\Trigram\Traits\GodNums\GodNums;
use Maturest\Trigram\Traits\GodNums\Gram;
use Maturest\Trigram\Traits\GodNums\Prosper;
use Maturest\Trigram\Traits\GodNums\Raw;
use Maturest\Trigram\Traits\GodNums\Wx;
use Maturest\Trigram\Traits\GodNums\YinYang;

class Plate extends BaseService
{
    use Gram, GodNums, Wx, YinYang, Raw, Prosper;

    /**
     * It takes a date, converts it to a solar date, then gets the front and later numbers, then gets
     * the relations between the front and later numbers
     *
     * @param date The date you want to get the result.
     * @return mixed
     */
    public function getResultBySolar($date)
    {
        $this->solar($date);

        $frontNums = $this->frontNums($date);

        $laterNums = $this->laterNums($frontNums);

        $relations = $this->relations($frontNums, $laterNums);

        return $relations;
    }


    /**
     * It takes two arrays of numbers, and returns an array of arrays of numbers
     *
     * @param frontNums The first number of the wallet password
     * @param laterNums The last six digits of the wallet password
     * @return mixed
     */
    protected function relations($frontNums, $laterNums)
    {

        $front_nums = $this->createNewArr($frontNums);

        $later_nums = $this->createNewArr($laterNums);

        $grams = $this->getGramRelation($frontNums, $front_nums, $laterNums, $later_nums);

        $yin_yang = $this->getYinYangRelation($front_nums, $later_nums);

        $raws = $this->getRawRelation($frontNums, $front_nums, $laterNums, $later_nums);

        $prosper = $this->getProsperRelation($frontNums, $front_nums, $laterNums, $later_nums);

        $wx = $this->getWxByNums($front_nums, $later_nums);

        $fate = $this->getFateByGz(new WalletPassword());

        return array_merge(compact('front_nums', 'later_nums'), $grams, $wx, $yin_yang, $raws, $prosper, $fate);
    }


    /**
     * > Get the fate of the year by the ganzhi of the year
     *
     * @param WalletPassword walletPassword The object of the class WalletPassword
     *
     * @return The fate of the year.
     */
    public function getFateByGz(WalletPassword $walletPassword)
    {
        $row = $walletPassword->getNaYin($this->date_detail['ganzhi_year']);
        return ['fate' => $row['fate'] ?? ''];
    }


    /**
     * > It takes a date and returns a list of numbers that are related to that date
     *
     * @param date The date you want to calculate, in the format of YYYY-MM-DD.
     * @param isLeapMonth Whether it is a leap month.
     * @return mixed
     */
    public function getResultByLunar($date, $isLeapMonth = false)
    {
        $this->lunar($date, $isLeapMonth);

        $frontNums = $this->frontNums($date);
        $laterNums = $this->laterNums($frontNums);

        $relations = $this->relations($frontNums, $laterNums);

        return $relations;
    }
}