<?php
declare(strict_types=1);

namespace App\Auth\Command\Login\Confirm;

final class Command
{
    public string $email = '';

    public string $code = '';
}
