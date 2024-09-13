<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\Models\User;

class SecurityController extends Controller
{
    public function register(): void
    {
        $form = new Register();
        $formConfig = $form->getConfig();

        if ($_SERVER['REQUEST_METHOD'] === $formConfig['config']['method']) {
            if ($this->verificator->checkForm($formConfig, $_POST)) {
                // Create and save the new user
                $newUser = new User();
                $newUser->setEmail($_POST['email']);
                $newUser->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
                $newUser->setStatus('inactive'); // Default status for a new user
                $newUser->save();

                $_SESSION['email'] = $newUser->getEmail();
                $this->redirect('/verification');
            } else {
                // Form validation failed
                $formConfig['config']['errorMessage'] = 'Form is invalid';
            }
        }

        $view = new View('Security/register', 'frontSecurity');
        $view->assign('formConfig', $formConfig);
    }

    public function verification(): void
    {
        
    }

    public function login(): void
    {
        $form = new Login();
        $formConfig = $form->getConfig();
    
        if ($_SERVER['REQUEST_METHOD'] === $formConfig['config']['method']) {
            if ($this->verificator->checkForm($formConfig, $_POST)) {
                $user = new User();
                $user = $user->findByEmail($_POST['email']);
    
                if ($user && password_verify($_POST['password'], $user->getPassword())) {
                    $_SESSION['email'] = $user->getEmail();
                    $this->redirect('/dashboard');
                } else {
                    $formConfig['config']['errorMessage'] = 'Invalid email or password';
                }
            } else {
                $formConfig['config']['errorMessage'] = 'Form is invalid';
            }
        }
    
        $view = new View('Security/login', 'frontSecurity');
        $view->assign('formConfig', $formConfig);
    }
    
}
