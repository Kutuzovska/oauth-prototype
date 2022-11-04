<?php
declare(strict_types=1);

namespace App\Auth\Tests\Unit\Entity\Service;

use App\Auth\Service\Tokenizer;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class TokenizerTest extends TestCase
{
    public function testSuccess(): void
    {
        $interval = new DateInterval('PT5M');
        $date = new DateTimeImmutable('+5 minutes');

        $tokenizer = new Tokenizer($interval);
        $token = $tokenizer->generate('1234', $date);

        self::assertEquals($date->add($interval), $token->getExpires());
    }
}
