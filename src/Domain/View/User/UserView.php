<?php

namespace App\Domain\View\User;

use App\Domain\Entity\User;

class UserView
{
    private ?string $firstName = null;
    private ?string $id = null;
    private ?string $email;
    private ?string $username;
    /**
     * @var ?string The hashed password
     */
    private ?string $password = null;
    private ?string $repeatPassword = null;
    private array $roles;

    public function __construct()
    {
        $this->roles = ['ROLE_ADMIN'];
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getRepeatPassword(): ?string
    {
        return $this->repeatPassword;
    }

    public function setRepeatPassword(?string $repeatPassword): void
    {
        $this->repeatPassword = $repeatPassword;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }
}
