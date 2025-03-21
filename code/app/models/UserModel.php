<?php

class UserModel {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getUserByUsername($username): ?array{
        $statement = $this->db->prepare(<<<sql
            SELECT * 
            FROM users 
            WHERE username = :username
        sql);
        $statement->bindValue(':username', $username);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    

    /**
     * Creates a user in the database.
     * 
     * @param array{username, email, password, image, bio} $userData
     * @return void
     */
    public function createUser(array $userData) {
        // still TODO: insert profile picture
        $statement = $this->db->prepare(<<<SQL
            INSERT INTO users(username, email, password, user_bio)
            VALUES(?, ?, ?, ?);
        SQL);
        $statement->bindValue(1, $userData['username']);
        $statement->bindValue(2, $userData['email']);
        $statement->bindValue(3, $userData['password']);
        $statement->bindValue(4, $userData['bio']);
        $statement->execute();
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
