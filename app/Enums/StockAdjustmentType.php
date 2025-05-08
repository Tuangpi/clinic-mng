<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StockAdjustmentType extends Enum
{
    const StockTransferSender = 2;
    const StockTransferReceiver = 3;
    const ReturnToSupplier = 4;
}
