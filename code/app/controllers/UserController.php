<?php

include __DIR__.'/../models/User.php';

class UserController {
    function register() {
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/register-view.php';
        }
        // Otherwise, handle the submission:
        else {
            // TODO use the data model to add a new user to the DB, using the values from the post request
            //e.g.
            $newUser = new User();
            $newUser->$username = $_POST['username'];
            $newUser->save(); //or something like that

            //redirect to another page
            header('Location: /login');
            exit;
        }
    }
}

?>