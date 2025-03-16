<?php

class UserModel {
    private $db;

    public function __contruct($db) {
        $this->db = $db;
    }

    public function getUserByUsername($username): array {
        //not sure if it is best to return User object or associative array
        return [];
    }

    /**
     * Creates a user in the database.
     * 
     * @param array{username, email, password, image, bio} $userData
     * @return void
     */
    public function createUser(array $userData) {

    }

    /**
     * Updates an existing user's data in the database
     * 
     * @param array{username, email, password, image, bio} $userData
     * @return void
     */
    public function updateUser(array $userData) {

    }

    /**
     * Returns an array of string usernames
     * @return array
     */
    public function getAllUsernames(): array {
        //for admin dashboard stuff, for example
        return [];
    }
}

?>