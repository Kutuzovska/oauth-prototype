<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

use DateTimeImmutable;
use Webmozart\Assert\Assert;

final class Token
{
    private const TOKEN_LENGTH = 4;
    private readonly string $value;
    private readonly DateTimeImmutable $expires;

    public function __construct(string $value, DateTimeImmutable $expires)
    {
        Assert::notEmpty($value);
        Assert::digits($value);
        Assert::length($value, self::TOKEN_LENGTH);

        $this->value = $value;
        $this->expires = $expires;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getExpires(): DateTimeImmutable
    {
        return $this->expires;
    }
}
