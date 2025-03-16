<?php

include __DIR__.'/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function register() {
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/register-view.php';
        }
        // Otherwise, handle the submission:
        else {
            $this->userModel->createUser([
                'username'  => $_POST['username'],
                'email'     => $_POST['email'],
                'password'  => $_POST['password'],
                'image'     => $_POST['image'],
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