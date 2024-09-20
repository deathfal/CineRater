<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\User;
use App\Repository\UserRepository;

class AdminController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    // Display the admin dashboard with a list of users
    public function index(): void
    {
        $users = $this->userRepository->findAll(); 

        // var_dump($users);
        // Define columns for the user table
        $columns = ['Email', 'Role', 'Actions'];

        $view = new View('Admin/users', "front");
        $view->assign('title', 'User Management');
        $view->assign('entityName', 'User');
        $view->assign('columns', $columns);
        $view->assign('items', $users); 
    }

    // Add a new user (admin functionality)
    public function createUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role'] ?? 'user'; // Default role is 'user'

            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setPassword($password);
            $newUser->setRole($role);

            if ($this->userRepository->save($newUser)) {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['status' => 'success', 'message' => 'User created successfully.']);
                    return;
                }
                $this->redirect('/admin');
            } else {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create user.']);
                    return;
                }
                // Handle error for non-AJAX requests
                $view = new View('Admin/create', 'admin');
                $view->assign('error', 'Failed to create user.');
            }
        }
    }

    // Utility function to check if the request is an AJAX request
    private function isAjaxRequest(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    // Edit user (admin functionality)
    public function editUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['id'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $user = $this->userRepository->findById($userId);

            if ($user) {
                $user->setEmail($email);
                $user->setRole($role);

                if ($this->userRepository->save($user)) {
                    if ($this->isAjaxRequest()) {
                        echo json_encode(['status' => 'success', 'message' => 'User updated successfully.']);
                        return;
                    }
                    $this->redirect('/admin');
                } else {
                    if ($this->isAjaxRequest()) {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to update user.']);
                        return;
                    }
                }
            } else {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
                    return;
                }
            }
        }
    }


    public function deleteUser(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $userId = $_POST['id'];
        
        if ($this->userRepository->delete($userId)) {
            if ($this->isAjaxRequest()) {
                echo json_encode(['status' => 'success']);
                return;
            }
            $this->redirect('/admin');
        } else {
            if ($this->isAjaxRequest()) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete user.']);
                return;
            }
            // Handle error
            $view = new View('Admin/dashboard', 'front');
            $view->assign('error', 'Failed to delete user.');
        }
    }
}
}
