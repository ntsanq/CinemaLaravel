<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SeatStatus extends Enum
{
    const UnBooked = 0;
    const Booked = 1;
}
