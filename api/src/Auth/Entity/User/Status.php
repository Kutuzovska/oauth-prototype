<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

enum Status: string
{
    case WAIT = 'wait';
    case ACTIVE = 'active';

    public function isWait(): bool {
        return $this === self::WAIT;
    }

    public function isActive(): bool {
        return $this === self::ACTIVE;
    }
}
