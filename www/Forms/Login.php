<?php

namespace App\Forms;

class Login
{
    public function getConfig(): array
    {
        return [
            'config' => [
                'method' => 'POST',
                'action' => '/login',
                'class' => 'login-form',
                'id' => 'loginForm',
                'submit' => 'Login',
                'errorMessage' => null
            ],
            'inputs' => [
                'email' => [
                    'type' => 'email',
                    'label' => 'Email',
                    'id' => 'email',
                    'placeholder' => 'Your email',
                    'required' => true
                ],
                'password' => [
                    'type' => 'password',
                    'label' => 'Password',
                    'id' => 'password',
                    'placeholder' => 'Your password',
                    'required' => true
                ]
            ]
        ];
    }
}
