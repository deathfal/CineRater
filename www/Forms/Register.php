<?php

namespace App\Forms;

use App\Core\Form;

class Register extends Form
{
    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "/register",
            "class" => "form",
            "id" => "form-register",
            "submit" => "Créer un compte",
            "errorMessage" => "Erreur lors de la création du compte"
        ];

        $this->inputs = [
            "email" => [
                "label" => "Email",
                "type" => "email",
                "id" => "form-register-email",
                "required" => true,
                "placeholder" => "Votre email"
            ],
            "password" => [
                "label" => "Mot de passe",
                "type" => "password",
                "id" => "form-register-password",
                "required" => true,
                "placeholder" => "Votre mot de passe"
            ],
            "passwordConfirm" => [
                "label" => "Confirmer le mot de passe",
                "type" => "password",
                "id" => "form-register-password-confirm",
                "required" => true,
                "placeholder" => "Confirmez votre mot de passe",
                "confirm" => "password"
            ]
        ];

        parent::__construct();
    }
}
