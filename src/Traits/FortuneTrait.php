<?php

namespace Maturest\Trigram\Traits;

use Maturest\Trigram\Traits\Fortune\AccTrait;
use Maturest\Trigram\Traits\Fortune\CommonRelationTrait;
use Maturest\Trigram\Traits\Fortune\DissolveTrait;
use Maturest\Trigram\Traits\Fortune\GodTrait;
use Maturest\Trigram\Traits\Fortune\GoodIllTrait;
use Maturest\Trigram\Traits\Fortune\NumenTrait;
use Maturest\Trigram\Traits\Fortune\ShieldTrait;
use Maturest\Trigram\Traits\Fortune\WealthTrait;
use Maturest\Trigram\Traits\Fortune\HonourableMenTrait;

trait FortuneTrait
{
    //用神的位置,数组
    public $god_positions = [];

    use GodTrait, CommonRelationTrait, NumenTrait, GoodIllTrait, ShieldTrait, AccTrait, DissolveTrait;

    use WealthTrait, HonourableMenTrait;
}