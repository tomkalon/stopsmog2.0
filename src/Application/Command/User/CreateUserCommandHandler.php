<?php

namespace App\Application\Command\User;

use App\Application\Service\CQRS\Command\CommandHandlerInterface;
use App\Application\Service\User\CreateUserServiceInterface;

readonly class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateUserServiceInterface $saveUserService,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $userView = $command->getUserView();

        $this->saveUserService->persist($userView);
    }
}
