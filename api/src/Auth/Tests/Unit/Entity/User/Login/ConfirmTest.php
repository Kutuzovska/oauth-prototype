<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User\Login;

use App\Auth\Entity\User\Code;
use App\Auth\Entity\User\Token;
use App\Auth\Tests\Builder\UserBuilder;
use PHPUnit\Framework\TestCase;

final class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
        $code = new Code('1234');
        $token = new Token($code, $now = (new \DateTimeImmutable())->modify('+1 day'));

        $user = (new UserBuilder())
            ->withToken($token)
            ->build();

        self::assertTrue($user->isWait());

        $user->confirm($code);

        self::assertTrue($user->isActive());
        self::assertFalse($user->isWait());
        self::assertNull($user->getLoginConfirmToken());
    }

    public function testExpire(): void
    {
        $code = new Code('1234');
        $token = new Token($code, $now = (new \DateTimeImmutable())->modify('-1 day'));

        $user = (new UserBuilder())
            ->withToken($token)
            ->build();

        $this->expectException(\DomainException::class);
        $user->confirm($code);
    }

    public function testInvalidCode(): void
    {
        $code = new Code('1234');
        $token = new Token($code, $now = (new \DateTimeImmutable())->modify('+1 day'));

        $user = (new UserBuilder())
            ->withToken($token)
            ->build();

        $this->expectException(\DomainException::class);
        $user->confirm(new Code('1235'));
    }

    public function testEmptyToken(): void
    {
        $user = (new UserBuilder())->build();
        $this->expectException(\DomainException::class);
        $user->confirm(new Code('1235'));
    }

    public function testAlreadyActive(): void
    {
        $user = (new UserBuilder())
            ->active()
            ->build();
        $this->expectException(\DomainException::class);
        $user->confirm(new Code('1235'));
    }
}
