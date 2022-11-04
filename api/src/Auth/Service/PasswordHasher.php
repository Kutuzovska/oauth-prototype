<?php
declare(strict_types=1);

namespace App\Auth\Service;

use RuntimeException;
use Webmozart\Assert\Assert;

final class PasswordHasher
{
    private const PASSWORD_MIN_LENGTH = 5;

    public function hash(string $password): string
    {
        Assert::notEmpty($password);
        Assert::minLength($password, self::PASSWORD_MIN_LENGTH);

        $hash = password_hash($password, PASSWORD_ARGON2I);

        if (empty($hash)) {
            throw new RuntimeException('Unable to generate hash');
        }

        return $hash;
    }

    public function validate(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
