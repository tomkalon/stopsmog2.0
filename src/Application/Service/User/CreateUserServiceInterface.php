<?php

namespace App\Application\Service\User;


use App\Domain\View\User\UserView;

interface CreateUserServiceInterface
{
    public function persist(UserView $userView): void;
}
