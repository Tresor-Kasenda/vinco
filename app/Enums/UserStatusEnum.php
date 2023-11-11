<?php

declare(strict_types=1);

namespace App\Enums;

enum UserStatusEnum: int
{
    case ACTIVE = 1;

    case INACTIVE = 0;

    /**
     * Get the value of the enum item.
     * @return UserStatusEnum
     */
    public function getValue(): UserStatusEnum
    {
        return [self::ACTIVE, self::INACTIVE][$this->value];
    }
}
