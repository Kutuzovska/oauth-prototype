<?php
declare(strict_types=1);

namespace App\Auth\Command\SignUp;

final class Command
{
    public string $email = '';
    public string $password = '';
    public string $phone = '';
    public string $firstName = '';
    public string $lastName = '';
    public string $patronymic  = '';
}