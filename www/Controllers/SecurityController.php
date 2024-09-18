<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Forms\Register;
use App\Forms\Login;
use App\Models\User;
use App\Core\Mailer;

class SecurityController extends Controller
{

    public function register(): void
    {
        $form = new Register();
        $formConfig = $form->getConfig();

        if ($_SERVER['REQUEST_METHOD'] === strtoupper($formConfig['config']['method'])) {
            if ($this->verificator->checkForm($formConfig, $_POST)) {
                $userModel = new User();

                if ($userModel->findByEmail($_POST['email'])) {
                    $formConfig['config']['errorMessage'] = 'A user with this email already exists.';
                } else {
                    $newUser = new User();
                    $newUser->setEmail($_POST['email']);
                    $newUser->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
                    $newUser->setRole('unverified'); // Default role

                    $activationToken = bin2hex(random_bytes(16));
                    $newUser->setActivationToken($activationToken);

                    if ($newUser->save()) {
                        $activationLink = "http://localhost/verification?email=" . urlencode($newUser->getEmail()) . "&token=" . $activationToken;
                        $subject = "Activate your account";
                        $body = "<p>Click the link below to activate your account:</p><a href='{$activationLink}'>Activate</a>";

                        Mailer::sendMail($newUser->getEmail(), $subject, $body);
                        $this->redirect('/verification-pending');
                    } else {
                        $formConfig['config']['errorMessage'] = 'Error creating account. Try again.';
                    }
                }
            } else {
                $formConfig['config']['errorMessage'] = 'Form is invalid.';
            }
        }

        $view = new View('Security/register', 'frontSecurity');
        $view->assign('formConfig', $formConfig);
    }



    public function verificationPending(): void
    {
        $view = new View('Security/verification-pending', 'frontSecurity');
        $view->assign('message', 'Congrats, you\'re registered. An email has been sent to verify your account.');
    }

    public function verification(): void
    {
        if (isset($_GET['email']) && isset($_GET['token'])) {
            $email = $_GET['email'];
            $token = $_GET['token'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && $user->getActivationToken() === $token) {
                if ($user->activate($token)) {
                    $view = new View('Security/verify', 'frontSecurity');
                    $view->assign('message', 'Your account has been activated. You can now log in.');
                    return;
                }
            }
            $view = new View('Security/verify', 'frontSecurity');
            $view->assign('message', 'Invalid activation link.');
        } else {
            $view = new View('Security/verify', 'frontSecurity');
            $view->assign('message', 'Invalid activation link.');
        }
    }
    public function login(): void
    {
        $form = new Login();
        $formConfig = $form->getConfig();

        if ($_SERVER['REQUEST_METHOD'] === strtoupper($formConfig['config']['method'])) {
            if ($this->verificator->checkForm($formConfig, $_POST)) {
                $userModel = new User();
                $user = $userModel->findByEmail($_POST['email']);

                if ($user) {
                    if (password_verify($_POST['password'], $user->getPassword())) {
                        if ($user->getRole() === 'unverified') {
                            $formConfig['config']['errorMessage'] = 'Your account is not verified.';
                        } else {
                            $_SESSION['email'] = $user->getEmail();
                            $_SESSION['role'] = $user->getRole();
                            $this->redirect('/');
                        }
                    } else {
                        $formConfig['config']['errorMessage'] = 'Incorrect password.';
                    }
                } else {
                    $formConfig['config']['errorMessage'] = 'Account not found.';
                }
            } else {
                $formConfig['config']['errorMessage'] = 'Form is invalid.';
            }
        }

        $view = new View('Security/login', 'frontSecurity');
        $view->assign('formConfig', $formConfig);
    }

    public function logout(): void
    {
        $_SESSION = [];

        session_destroy();

        $this->redirect('/');
    }




}
