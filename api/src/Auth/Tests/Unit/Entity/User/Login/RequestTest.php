<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User\Login;

use App\Auth\Entity\User\Code;
use App\Auth\Entity\User\Token;
use App\Auth\Tests\Builder\UserBuilder;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $code = new Code('1234');
        $token = new Token($code, $now = new \DateTimeImmutable());

        $user = (new UserBuilder())->build();

        self::assertNull($user->getLoginConfirmToken());
        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        $user->setLoginConfirmToken($token);

        self::assertNotNull($user->getLoginConfirmToken());
        self::assertEquals($code->getValue(), $user->getLoginConfirmToken()?->getValue());
        self::assertEquals($now, $user->getLoginConfirmToken()?->getExpires());
    }
}
