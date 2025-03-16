<?php

class UserModel {
    private $db;

    public function __contruct($db) {
        $this->db = $db;
    }

    public function getUserByUsername($username): User {
        //not sure if it is best to return User object or associative array
    }

    /**
     * Creates a user in the database.
     * 
     * `$userData` is expected to have the following keys:
     * ```
     * 'username'
     * 'email'
     * 'password'
     * 'image'
     * 'bio'
     * ```
     * @param array $userData
     * @return void
     */
    public function createUser(array $userData) {

    }

    public function updateUser() {

    }

    public function getAllUsers() {
        //for admin dashboard stuff, for example
    }
}

?>