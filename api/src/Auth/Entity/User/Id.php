<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

use Symfony\Component\Uid\Uuid;
use Webmozart\Assert\Assert;

final class Id
{
    private readonly string $value;

    public function __construct(string $value)
    {
        Assert::uuid($value);
        $this->value = $value;
    }

    public static function generate(): self
    {
        return new self(Uuid::v4()->toRfc4122());
    }

    public function getValue(): string
    {
        return $this->value;
    }
}