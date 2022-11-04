<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

use DateTimeImmutable;
use DomainException;
use Webmozart\Assert\Assert;

final class Token
{
    private readonly Code $code;
    private readonly DateTimeImmutable $expires;

    public function __construct(Code $code, DateTimeImmutable $expires)
    {
        $this->code = $code;
        $this->expires = $expires;
    }

    public function getValue(): string
    {
        return $this->code->getValue();
    }

    public function getExpires(): DateTimeImmutable
    {
        return $this->expires;
    }

    public function validate(Code $code, DateTimeImmutable $date): void
    {
        if ($this->getValue() !== $code->getValue()) {
            throw new DomainException('Token is invalid');
        }

        if ($this->getExpires() < $date) {
            throw new DomainException('Token is expire');
        }
    }
}
