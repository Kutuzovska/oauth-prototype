<?php
declare(strict_types=1);

namespace App\Auth\Command\Login\Request;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\LoginConfirmationSender;
use App\Auth\Service\PasswordHasher;
use DomainException;

final class Handler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordHasher $hasher,
        private readonly LoginConfirmationSender $sender,
        private readonly Flusher        $flusher,
    )
    {
    }

    public function __invoke(Command $command): void
    {
        $email = new Email($command->email);
        $user = $this->userRepository->getByEmail($email);
        if (!$this->hasher->validate($command->password, $user->getPasswordHash())) {
            throw new DomainException('Email or password is incorrect');
        }

        if ($user->isActive()) {
            throw new DomainException('User already active!');
        }

        $token = $this->sender->send($user->getPhone());
        $user->setLoginConfirmToken($token);

        $this->userRepository->save($user);
        $this->flusher->flush();
    }
}
