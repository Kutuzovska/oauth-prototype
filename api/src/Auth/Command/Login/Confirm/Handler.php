<?php
declare(strict_types=1);

namespace App\Auth\Command\Login\Confirm;

use App\Auth\Entity\User\Code;
use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\UserRepository;
use DomainException;

final class Handler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly Flusher        $flusher,
    )
    {
    }

    public function __invoke(Command $command): void
    {
        $email = new Email($command->email);
        $code = new Code($command->code);

        $user = $this->userRepository->getByEmail($email);
        $user->confirm($code);
        $this->userRepository->save($user);
        $this->flusher->flush();
    }
}
