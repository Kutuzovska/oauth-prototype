<?php
declare(strict_types=1);

namespace App\Auth\Service;

use App\Auth\Entity\User\Token;
use DateInterval;
use DateTimeImmutable;

final class Tokenizer
{
    public function __construct(private readonly DateInterval $interval)
    {
    }

    public function generate(string $code, DateTimeImmutable $date): Token
    {
        return new Token($code, $date->add($this->interval));
    }
}
