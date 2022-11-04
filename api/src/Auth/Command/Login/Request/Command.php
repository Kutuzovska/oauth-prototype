<?php
declare(strict_types=1);

namespace App\Auth\Command\Login\Request;

final class Command
{
    public string $email;

    public string $password;
}
