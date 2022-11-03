<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User;

use App\Auth\Entity\User\Phone;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class PhoneTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Phone('');
    }

    public function testSuccess(): void
    {
        $phone = new Phone('88005553535');
        self::assertEquals('+7 800 555-35-35', $phone->getValue());
    }


    public function testIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Phone('14842634409');
    }
}