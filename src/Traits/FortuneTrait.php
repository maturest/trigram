<?php

namespace Maturest\Trigram\Traits;

use Maturest\Trigram\Traits\Fortune\GoodIllTrait;
use Maturest\Trigram\Traits\Fortune\NumenTrait;
use Maturest\Trigram\Traits\Fortune\ShieldTrait;
use Maturest\Trigram\Traits\Fortune\AccTrait;
use Maturest\Trigram\Traits\Fortune\DissolveTrait;

trait FortuneTrait
{
    //用神的位置,数组
    protected $god_position = [];

    //世的位置
    protected $shi_position = [];


    use NumenTrait, GoodIllTrait,ShieldTrait,AccTrait,DissolveTrait;
}