<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RecurringType extends Enum
{
    const Daily = 1;
    const Weekly = 2;
    const Monthly = 3;
}
