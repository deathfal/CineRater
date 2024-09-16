<?php

namespace App\Models;

use App\Core\DB;

class User
{
    protected string $email;
    protected string $password;
    protected string $status;
    protected ?string $activation_token = null;
    protected string $role = 'unverified';

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

    public function setActivationToken(?string $token): void
    {
        $this->activation_token = $token;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    // Save or update the user in the database
    public function save(): bool
    {
        $db = DB::getInstance();

        // Check if user already exists
        $existingUser = $this->findByEmail($this->email);

        if ($existingUser) {
            // Update existing user
            return $db->update('users', [
                'password' => $this->password,
                'status' => $this->status,
                'activation_token' => $this->activation_token
            ], ['email' => $this->email]);
        } else {
            // Create new user
            return $db->create('users', [
                'email' => $this->email,
                'password' => $this->password,
                'status' => $this->status,
                'activation_token' => $this->activation_token
            ]);
        }
    }

    // Update user status
    public function updateStatus(string $newStatus): bool
    {
        $this->status = $newStatus;
        return DB::getInstance()->update('users', ['status' => $newStatus], ['email' => $this->email]);
    }

    // Delete user
    public function deleteUser(): bool
    {
        return DB::getInstance()->delete('users', ['email' => $this->email]);
    }

    // Find user by email
    public function findByEmail(string $email): ?self
    {
        $db = DB::getInstance();
        $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        if ($userData) {
    
            $user = new self();
            $user->setEmail($userData['email']);
            $user->setPassword($userData['password']);
            $user->setStatus($userData['status']);
            $user->setActivationToken($userData['activation_token']);
            $user->role = $userData['role'];
            return $user;
        } else {
            error_log("No user found with email: " . $email);
            return null;
        }
    }
    
    
    public function activate(string $token): bool
    {
        return DB::getInstance()->update('users', ['role' => 'user', 'activation_token' => null], ['email' => $this->email, 'activation_token' => $token]);
    }
    
}
