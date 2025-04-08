<?php

require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../services/AuthAccess.php';
require_once __DIR__.'/../services/AuthStatus.php';

class UserController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    public function register() {
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $isLoggedIn = AuthService::isLoggedIn();
            $isAdmin = AuthService::isAdmin();

            // this view uses: $isLoggedIn, $isAdmin
            require __DIR__.'/../views/register-view.php';
        }
        else {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $userExists = $this->userModel->checkUserExists($username, $email);

            if (!$userExists) {
                $this->userModel->createUser([
                    'username'  => $_POST['username'],
                    'email'     => $_POST['email'],
                    'password'  => $_POST['password'],
                    'image'     => $_FILES['profile-picture'],
                    'bio'       => 'This user has not added a bio yet.'
                ]);
        
                //redirect to another page
                header('location: '.routeUrl('/login'));
                exit;
            } else {
                $_SESSION['invalid_registration'] = 'Username or email is already registered.';
                header('location: '.routeUrl('/register'));
                exit;
            }
        }
    }

    public function login() {
        // If form is not submitted, display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $isLoggedIn = AuthService::isLoggedIn();
            $isAdmin = AuthService::isAdmin();

            // this view uses: $isLoggedIn, $isAdmin
            require __DIR__.'/../views/login-view.php';
        }
        // Otherwise, handle the submission:
        else {
            if (!isset($_POST['email']) || empty($_POST['email'])) {
                header('location: '.routeUrl('/login'));
            }
            if (!isset($_POST['password']) || empty($_POST['password'])) {
                header('location: '.routeUrl('/login'));
            }

            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->validateUserLogin($email, $password);

            if ($user) {
                // Store user session data
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['profile-picture'] = $user['profile-picture'];
                $_SESSION['role'] = $user['role'];

                if ($_SESSION['role'] === 'admin') {
                    header('location: '.routeUrl('/admin'));
                    exit;
                } else {
                    header('location: '.routeUrl('/home'));
                    exit;
                }
            }
            else {
                $_SESSION['invalid_login'] = 'Email or password is invalid.';
                header('location: '.routeUrl('/login'));
                exit;
            }
        }
    }

    public function logout() {
        // Remove all session variables and destroy the session
        session_unset();
        session_destroy();
        header('location: '.routeUrl('/login'));
        exit;
    }

    public function updateSettings() {
        AuthAccess::restrictTo(['registered', 'admin']);
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: '.routeUrl('/profile/settings'));
            exit;
        }
    
        $username = $_SESSION['username'];
        $currentPassword = $_POST['current-password'] ?? '';
        $newPassword = $_POST['new-password'] ?? '';
        $confirmPassword = $_POST['confirm-password'] ?? '';
        $userBio = $_POST['user-bio'] ?? '';
    
        $user = $this->userModel->getUserByUsername($username);
        if (!$user || !password_verify($currentPassword, $user['password'])) {
            $_SESSION['error'] = 'Current password is incorrect';
            header('Location: '.routeUrl('/profile/settings'));
            exit;
        }

        $updateData = [
            'username' => $_SESSION['username'],
            'user_bio' => !empty($userBio) ? $userBio : 'This user has not yet added a bio'
        ];

        if (!empty($newPassword)) {
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = 'New passwords do not match';
                header('Location: '.routeUrl('/profile/settings'));
                exit;
            }
            $updateData['password'] = $newPassword;
        }

        if (!empty($_FILES['profile-picture']['tmp_name'])) {
            $updateData['profile_picture'] = $_FILES['profile-picture'];
        }

        if ($this->userModel->updateUser($updateData)) {
            if (isset($updateData['profile_picture'])) {
                $user = $this->userModel->getUserByUsername($username);
                $_SESSION['profile-picture'] = $user['profile-picture'];
            }
            $_SESSION['success'] = 'Settings updated successfully';
        } else {
            $_SESSION['error'] = 'Failed to update settings';
        }

        header('Location: '.routeUrl('/profile/settings'));
        exit;
    }

}

?>