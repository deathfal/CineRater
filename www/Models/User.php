<?php

namespace App\Models;

use App\Repository\UserRepository;

class User
{
    protected string $id;
    protected string $email;
    protected string $password;
    protected ?string $activation_token = null;
    protected string $role = 'unverified'; // Default role


    public function __construct()
    {
        $this->id = bin2hex(random_bytes(6));
    }
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setActivationToken(?string $token): void
    {
        $this->activation_token = $token;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function save(): bool
    {
        if (!$this->id) {
            $this->id = bin2hex(random_bytes(6));
        }

        $repository = new UserRepository();
        return $repository->save($this);
    }
    public function findByEmail(string $email): ?self
    {
        $repository = new UserRepository();
        return $repository->findByEmail($email);
    }

    public function activate(string $token): bool
    {
        $repository = new UserRepository();
        return $repository->activate($this, $token);
    }

    public function getTotalUsers(): int
    {
        $repository = new UserRepository();
        return $repository->getTotalUsers();
    }
}
