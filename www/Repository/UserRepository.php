<?php

namespace App\Repository;

use App\Core\DB;
use App\Models\User;

class UserRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function save(User $user): bool
    {
        $existingUser = $this->findById($user->getId());

        if ($existingUser) {
            // Update existing user
            return $this->db->update('users', [
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
                'activation_token' => $user->getActivationToken()
            ], ['id' => $user->getId()]);
        } else {
            // Create a new user
            return $this->db->create('users', [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
                'activation_token' => $user->getActivationToken()
            ]);
        }
    }
    public function activate(User $user, string $token): bool
    {
        return $this->db->update('users', ['role' => 'user', 'activation_token' => null], ['email' => $user->getEmail(), 'activation_token' => $token]);
    }

    public function getTotalUsers(): int
    {
        return $this->db->count('users');
    }

    public function findAll(): array
    {
        $users = [];
        $data = $this->db->findAll('users');

        foreach ($data as $row) {
            $user = new User();
            $user->setId($row['id']);
            $user->setEmail($row['email']);
            $user->setRole($row['role']);
            $user->setActivationToken($row['activation_token']);
            $users[] = $user;
        }

        return $users;
    }
    public function findById(string $id): ?User
    {
        $data = $this->db->find('users', ['id' => $id]);

        if ($data) {
            $user = new User();
            $user->setId($data['id']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRole($data['role']);
            $user->setActivationToken($data['activation_token']);
            return $user;
        }

        return null;
    }

    public function findByEmail(string $email): ?User
    {
        $data = $this->db->find('users', ['email' => $email]);

        if ($data) {
            $user = new User();
            $user->setId($data['id']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRole($data['role']);
            $user->setActivationToken($data['activation_token']);
            return $user;
        }

        return null;
    }

    public function delete(string $id): bool
    {
        return $this->db->delete('users', ['id' => $id]);
    }
}
