<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User;

use App\Auth\Entity\User\Token;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    public function testSuccess(): void
    {
        $token = new Token(
            $code = '1234',
            $now = new DateTimeImmutable(),
        );

        self::assertEquals($code, $token->getValue());
        self::assertEquals($now, $token->getExpires());
    }

    public function testIncorrectLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Token('123', new DateTimeImmutable());
    }

    public function testIncorrectFormat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Token('A12B', new DateTimeImmutable());
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Token('', new DateTimeImmutable());
    }
}