<?php


namespace Maturest\Trigram\Traits;


use Maturest\Trigram\Traits\Destiny\BuDiZhiTrait;
use Maturest\Trigram\Traits\Destiny\ConvergeSetTrait;
use Maturest\Trigram\Traits\Destiny\DilemmaTrait;
use Maturest\Trigram\Traits\Destiny\DrawTrait;
use Maturest\Trigram\Traits\Destiny\EnterTombTrait;
use Maturest\Trigram\Traits\Destiny\SixCongTrait;
use Maturest\Trigram\Traits\Destiny\SixHeTrait;
use Maturest\Trigram\Traits\Destiny\VoltTrigramTrait;
use Maturest\Trigram\Traits\Destiny\WhiteDeathTrait;

trait DestinyTrait
{
    use BuDiZhiTrait, WhiteDeathTrait, SixCongTrait, SixHeTrait, ConvergeSetTrait,
        EnterTombTrait, DilemmaTrait, VoltTrigramTrait, DrawTrait;
}