<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\User;

use App\Auth\Entity\User\Status;
use PHPUnit\Framework\TestCase;

final class StatusTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->assertTrue(Status::WAIT->isWait());
        $this->assertTrue(Status::ACTIVE->isActive());

        $this->assertFalse(Status::WAIT->isActive());
        $this->assertFalse(Status::ACTIVE->isWait());
    }
}
