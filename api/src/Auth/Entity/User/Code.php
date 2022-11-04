<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

use Webmozart\Assert\Assert;

final class Code
{
    private const TOKEN_LENGTH = 4;

    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::digits($value);
        Assert::length($value, self::TOKEN_LENGTH);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
