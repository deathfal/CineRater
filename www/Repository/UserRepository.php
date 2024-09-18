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
        $existingUser = $this->findByEmail($user->getEmail());

        if ($existingUser) {
            // Update existing user
            return $this->db->update('users', [
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
                'activation_token' => $user->getActivationToken()
            ], ['email' => $user->getEmail()]);
        } else {
            // Create a new user
            return $this->db->create('users', [
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
                'activation_token' => $user->getActivationToken()
            ]);
        }
    }

    public function findByEmail(string $email): ?User
    {
        $userData = $this->db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $userData->execute(['email' => $email]);
        $data = $userData->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRole($data['role']);
            $user->setActivationToken($data['activation_token']);
            return $user;
        }

        return null;
    }

    public function activate(User $user, string $token): bool
    {
        return $this->db->update('users', ['role' => 'user', 'activation_token' => null], ['email' => $user->getEmail(), 'activation_token' => $token]);
    }
}
