<?php

namespace App\Enums\Codebooks;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AssociateType extends Enum
{
    const MANUFACTURER = 'manufacturer';
    const SUPPLIER = 'supplier';
    const CONTRACTOR = 'contractor';
}
