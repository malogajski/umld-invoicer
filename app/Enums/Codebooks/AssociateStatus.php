<?php

namespace App\Enums\Codebooks;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AssociateStatus extends Enum
{
    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';
}
