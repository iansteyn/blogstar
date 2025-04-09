<?php
require_once __DIR__.'/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    public function register() {
        if (AuthStatus::isLoggedIn()) {
            Redirect::to('/home');
        }

        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $isLoggedIn = AuthStatus::isLoggedIn();
            $isAdmin = AuthStatus::isAdmin();

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
                Redirect::to('/login');
            }
            else {
                $_SESSION['invalid_registration'] = 'Username or email is already registered.';
                Redirect::to('/register');
            }
        }
    }

    public function login() {
        if (AuthStatus::isLoggedIn()) {
            Redirect::to('/home');
        }

        // If form is not submitted, display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $isLoggedIn = AuthStatus::isLoggedIn();
            $isAdmin = AuthStatus::isAdmin();

            // this view uses: $isLoggedIn, $isAdmin
            require __DIR__.'/../views/login-view.php';
        }
        // Otherwise, handle the submission:
        else {
            if (
                !isset($_POST['email']) or
                empty($_POST['email']) or
                !isset($_POST['password']) or
                empty($_POST['password'])
            ) {
                Redirect::to('/login');
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
                    Redirect::to('/admin');
                } else {
                    Redirect::to('/home');
                }
            }
            else {
                $_SESSION['invalid_login'] = 'Email or password is invalid.';
                Redirect::to('/login');
            }
        }
    }

    /** Remove all session variables and destroy the session */
    public function logout() {
        session_unset();
        session_destroy();
        Redirect::to('/login');
    }

    public function updateSettings() {
        ErrorService::requirePostRequest();
        AuthAccess::restrictTo(['registered', 'admin']);

        $username = $_SESSION['username'];
        $currentPassword = $_POST['current-password'] ?? '';
        $newPassword = $_POST['new-password'] ?? '';
        $confirmPassword = $_POST['confirm-password'] ?? '';
        $userBio = $_POST['user-bio'] ?? '';
    
        $user = $this->userModel->getUserByUsername($username);
        if (!$user || !password_verify($currentPassword, $user['password'])) {
            $_SESSION['error'] = 'Current password is incorrect';
            Redirect::to('/profile/settings');
        }

        $updateData = [
            'username' => $_SESSION['username'],
            'user_bio' => !empty($userBio) ? $userBio : 'This user has not yet added a bio'
        ];

        if (!empty($newPassword)) {
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = 'New passwords do not match';
                Redirect::to('/profile/settings');
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

        Redirect::to('/profile/settings');
    }

}

?>