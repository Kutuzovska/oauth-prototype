<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User;

use App\Auth\Entity\User\Code;
use App\Auth\Entity\User\Token;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class TokenTest extends TestCase
{
    public function testSuccess(): void
    {
        $code = new Code('1234');
        $token = new Token(
            $code,
            $now = new DateTimeImmutable(),
        );

        self::assertEquals($code->getValue(), $token->getValue());
        self::assertEquals($now, $token->getExpires());
    }

    public function testValidateWrongCode(): void
    {
        $code = new Code('1234');
        $token = new Token(
            $code,
            $now = new DateTimeImmutable(),
        );

        $this->expectException(\DomainException::class);
        $token->validate(new Code('1235'), $now->modify('-5 minutes'));
    }

    public function testValidateWrongExpire(): void
    {
        $code = new Code('1234');
        $token = new Token(
            $code,
            $now = new DateTimeImmutable(),
        );

        $this->expectException(\DomainException::class);
        $token->validate($code, $now->modify('+5 minutes'));
    }
}
