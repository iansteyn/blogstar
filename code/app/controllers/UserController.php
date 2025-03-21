<?php

include __DIR__.'/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    // change route in index and add method from pages controller, get it to display and then get the user model and call it in this model
    function profile() {
        $activeTab = $_GET['tab'] ?? "recent";
        require __DIR__.'/../views/profile-view.php';
    }

    public function register() {
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/register-view.php';
        }
        // Otherwise, handle the submission:
        else {
            $this->userModel->createUser([
                'username'  => $_POST['user-id'],
                'email'     => $_POST['email'],
                'password'  => $_POST['password'],
                // 'image'     => $_POST['profile-picture'],
                'bio'       => 'This user has not added a bio yet.'
            ]);

            //redirect to another page
            header('Location: /login');
            exit;
        }
    }

    public function login() {
        //TODO
    }

    public function logout() {
        //TODO
    }

    public function updateSettings() {
        //TODO
    }
}

?>