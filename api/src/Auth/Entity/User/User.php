<?php
declare(strict_types=1);

namespace App\Auth\Entity\User;

use DateTimeImmutable;

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

    public function isActive(): bool
    {
        return $this->status->isActive();
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

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
