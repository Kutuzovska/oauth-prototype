<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User;

use App\Auth\Entity\User\Code;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testSuccess(): void
    {
        $code = new Code($value = '1234');

        self::assertEquals($value, $code->getValue());
    }

    public function testIncorrectLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Code('123');
    }

    public function testIncorrectFormat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Code('A123');
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Code('');
    }
}
