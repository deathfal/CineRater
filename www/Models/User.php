<?php

namespace App\Models;

use App\Core\DB;

class User
{
    protected string $email;
    protected string $password;
    protected string $status;

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function save(): bool
    {
        return DB::getInstance()->create('users', [
            'email' => $this->email,
            'password' => $this->password,
            'status' => $this->status
        ]);
    }

    public function updateStatus(string $newStatus): bool
    {
        return DB::getInstance()->update('users', ['status' => $newStatus], ['email' => $this->email]);
    }

    public function deleteUser(): bool
    {
        return DB::getInstance()->delete('users', ['email' => $this->email]);
    }
}
