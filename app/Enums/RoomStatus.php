<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoomStatus extends Enum
{
    const UnFull = 0;
    const Full = 1;
}
