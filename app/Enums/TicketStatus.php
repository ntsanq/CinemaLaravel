<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TicketStatus extends Enum
{
    const UnPaid = 0;
    const  Paid = 1;
    const Expired = 2;
}
