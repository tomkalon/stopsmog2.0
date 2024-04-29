<?php

namespace App\Application\Command\User;

use App\Application\Service\CQRS\Command\CommandInterface;
use App\Domain\View\User\UserView;

readonly class CreateUserCommand implements CommandInterface
{
    public function __construct(
        private UserView $userView,
    )
    {
    }

    public function getUserView(): UserView
    {
        return $this->userView;
    }
}
