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
            return 'This is super user of system';
        }

        return parent::getDescription($value);
    }
}
