<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *
 */
final class UserRole extends Enum
{
    const Admin = 0;
    const Clerk = 1;
    const Customer = 2;

    public static function getDescription($value): string
    {
        if ($value === self::Admin) {
            return 'Administration user of system';
        }
        if ($value === self::Clerk) {
            return 'Staff of our system';
        }
        if ($value === self::Customer) {
            return 'Customer user in our system';
        }

        return parent::getDescription($value);
    }
}
