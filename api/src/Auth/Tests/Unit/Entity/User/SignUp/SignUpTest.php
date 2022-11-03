<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User\SignUp;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Phone;
use App\Auth\Entity\User\Token;
use App\Auth\Entity\User\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class SignUpTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = new User(
            $id = Id::generate(),
            $email = new Email('mail@example.com'),
            $phone = new Phone('88005553535'),
            $date = new DateTimeImmutable(),
            $hash = 'hash',
            $token = new Token('1234', new DateTimeImmutable()),
        );

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($phone, $user->getPhone());
        self::assertEquals($date, $user->getCreatedAt());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($token, $user->getLoginConfirmToken());

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
    }
}
