<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

use DateTimeImmutable;
use DomainException;

final class User
{
    private readonly Id $id;
    private readonly DateTimeImmutable $createdAt;
    private Email $email;
    private Phone $phone;
    private string $passwordHash;
    private ?Token $loginConfirmToken;

    private Status $status;

    public function __construct(
        Id                $id,
        Email             $email,
        Phone             $phone,
        DateTimeImmutable $createdAt,
        string            $passwordHash,
        ?Token            $token,
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->phone = $phone;
        $this->createdAt = $createdAt;
        $this->passwordHash = $passwordHash;
        $this->loginConfirmToken = $token;
        $this->status = Status::WAIT;
    }

    public function isWait(): bool
    {
        return $this->status->isWait();
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getLoginConfirmToken(): ?Token
    {
        return $this->loginConfirmToken;
    }

    public function setLoginConfirmToken(?Token $loginConfirmToken): void
    {
        $this->loginConfirmToken = $loginConfirmToken;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function confirm(Code $code): void
    {
        if ($this->isActive()) {
            throw new DomainException('User already active');
        }

        if ($this->loginConfirmToken === null) {
            throw new DomainException('No verification code, please send request');
        }

        $this->loginConfirmToken->validate($code, new DateTimeImmutable());
        $this->status = Status::ACTIVE;
        $this->loginConfirmToken = null;
    }

    public function isActive(): bool
    {
        return $this->status->isActive();
    }
}
