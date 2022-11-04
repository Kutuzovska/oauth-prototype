<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User\SignUp;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Phone;
use App\Auth\Entity\User\Token;
use App\Auth\Entity\User\User;
use App\Auth\Tests\Builder\UserBuilder;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class SignUpTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
    }
}
