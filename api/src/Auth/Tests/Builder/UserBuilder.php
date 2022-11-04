<?php
declare(strict_types=1);

namespace App\Auth\Tests\Builder;

use App\Auth\Entity\User\Code;
use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Phone;
use App\Auth\Entity\User\Token;
use App\Auth\Entity\User\User;
use DateTimeImmutable;

final class UserBuilder
{
    private Id $id;
    private Email $email;
    private string $passwordHash;
    private Phone $phone;
    private DateTimeImmutable $createdAt;
    private ?Token $loginConfirmToken;

    private bool $active = false;

    public function __construct()
    {
        $this->id = Id::generate();
        $this->email = new Email('mail@wxample.com');
        $this->phone = new Phone('88005553535');
        $this->passwordHash = 'hash';
        $this->createdAt = new DateTimeImmutable();
        $this->loginConfirmToken = null;
    }

    public function active(): self
    {
        $clone = clone $this;
        $clone->active = true;
        return $clone;
    }

    public function withToken(Token $token): self
    {
        $clone = clone $this;
        $clone->loginConfirmToken = $token;
        return $clone;
    }

    public function build(): User
    {
        $user = new User(
            $this->id,
            $this->email,
            $this->phone,
            $this->createdAt,
            $this->passwordHash,
            $this->loginConfirmToken,
        );

        if ($this->active) {
            $code = new Code('1234');
            $token = new Token($code, (new DateTimeImmutable())->modify('+1 day'));
            $user->setLoginConfirmToken($token);
            $user->confirm($code);
        }

        return $user;
    }
}
