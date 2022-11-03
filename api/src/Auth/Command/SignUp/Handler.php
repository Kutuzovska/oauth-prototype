<?php
declare(strict_types=1);

namespace App\Auth\Command\SignUp;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Phone;
use App\Auth\Entity\User\User;
use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\PasswordHasher;
use DateTimeImmutable;
use DomainException;

final class Handler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordHasher $hasher,
        private readonly Flusher        $flusher,
    )
    {
    }

    public function __invoke(Command $command): void
    {
        $email = new Email($command->email);
        if ($this->userRepository->hasByEmail($email)) {
            throw new DomainException('Email already exists');
        }

        $phone = new Phone($command->phone);
        if ($this->userRepository->hasByPhone($phone)) {
            throw new DomainException('Phone already exists');
        }

        $now = new DateTimeImmutable();

        $user = new User(
            Id::generate(),
            $email,
            $phone,
            $now,
            $this->hasher->hash($command->password),
            null,
        );

        $this->userRepository->add($user);
        $this->flusher->flush();
    }
}
