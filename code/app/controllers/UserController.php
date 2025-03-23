<?php
include __DIR__.'/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    // change route in index and add method from pages controller, get it to display and then get the user model and call it in this model
    function profile() {
        $userData = $this->userModel->getUserByUsername("Spooky");
        require __DIR__.'/../views/profile-view.php';
    }
    

    public function register() {
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/register-view.php';
        }
        if (!isset($_FILES['user-image']) || $_FILES['user-image']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("An image is required.");
        }
        // Otherwise, handle the submission:
        
            $this->userModel->createUser([
                'username'  => $_POST['username'],
                'email'     => $_POST['email'],
                'password'  => $_POST['password'],
                'image'     => $_FILES['user-image'],
                'bio'       => 'This user has not added a bio yet.'
            ]);

            //redirect to another page
            header('Location: /login');
            exit;
    }

    public function login() {
        // If form is not submitted, display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/login-view.php';
        }
        // Otherwise, handle the submission:
        else {
            if (!isset($_POST['email']) || empty($_POST['email'])) {
                header('Location: /login');
            }
            if (!isset($_POST['password']) || empty($_POST['password'])) {
                header('Location: /login');
            }

            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];  //TODO: Hash passwords
            $user = $this->userModel->validateUserLogin($email, $password);

            if ($user) {
                // Store user session data
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['profile_picture'] = $user['profile_picture'];
                $_SESSION['role'] = $user['role'];

                // Redirect to the home page
                header('Location: /home');
                exit;
            }
            else {
                $_SESSION['invalid_login'] = 'Email or password is invalid.';
                header('Location: /login');
                exit;
            }
        }
    }

    public function logout() {
        // Remove all session variables and destroy the session
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function updateSettings() {
        //TODO
    }
}

?>