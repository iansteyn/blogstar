<?php
require_once __DIR__.'/../helpers/model-helpers.php';

class UserModel {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function userExists(string $username): bool {
        $statement = $this->db->prepare(<<<sql
            SELECT username
            FROM users
            WHERE username = ?
        sql);
        $statement->execute([$username]);

        $result = $statement->fetch();
        return ! empty($result);
    }

    // TODO dont select password
    public function getUserByUsername($username): ?array{
        $statement = $this->db->prepare(<<<sql
            SELECT * 
            FROM users 
            WHERE username = :username
        sql);
        $statement->bindValue(':username', $username);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            $result['profile_picture'] = addImageMimeType($result['profile_picture']);
        }

        return $result ?: null;
    }
    
    /**
     * Check if a user already exists with the username or email
     * 
     * @param string $username
     * @param string $email
     * @return bool true if the username or email exists, false otherwise
     */
    public function checkUserExists($username, $email): bool {
        $statement = $this->db->prepare(<<<SQL
            SELECT COUNT(*)
            FROM users
            WHERE username = ? OR email = ?
        SQL);
        $statement->execute([$username, $email]);
        $result = $statement->fetchColumn();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates a user in the database.
     * 
     * @param array{username, email, password, image, bio} $userData
     * @return void
     */
    public function createUser(array $userData) {
        $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
        $imageBlob = file_get_contents($userData['image']['tmp_name']);

        $statement = $this->db->prepare(<<<SQL
            INSERT INTO users(username, email, password, profile_picture, user_bio)
            VALUES(?, ?, ?, ?, ?);
        SQL);
        $statement->bindValue(1, $userData['username']);
        $statement->bindValue(2, $userData['email']);
        $statement->bindValue(3, $hashedPassword);
        $statement->bindValue(4, $imageBlob); 
        $statement->bindValue(5, $userData['bio']);

        $statement->execute();
    }

    /**
     * Updates an existing user's data in the database
     * 
     * @param array{username, email, password, image, bio} $userData
     * @return bool
     */
    public function updateUser(array $userData): bool {
        $fields = [];
        $params = [':username' => $userData['username']];
        
        if (isset($userData['user_bio'])) {
            $fields[] = 'user_bio = :user_bio';
            $params[':user_bio'] = $userData['user_bio'];
        }
        
        if (isset($userData['password'])) {
            $fields[] = 'password = :password';
            $params[':password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        }
        
        if (isset($userData['profile_picture'])) {
            $imageBlob = file_get_contents($userData['profile_picture']['tmp_name']);
            $fields[] = 'profile_picture = :profile_picture';
            $params[':profile_picture'] = $imageBlob;
        }
        
        if (empty($fields)) {
            return false;
        }
        
        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    
    }

    /**
     * @param string $email 
     * @param string $password
     * @return array 
     * Array representing an existing user matching the passed 
     * email and password, or null if there is not a match.
     */
    public function validateUserLogin(string $email, string $password): ?array {
        $statement = $this->db->prepare(<<<SQL
            SELECT * 
            FROM users
            WHERE email = :email
        SQL);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return null;
    }

    /**
     * Note: this function can be modified to return more user info than just usernames, if desired.
     * 
     * @param string $searchTerm the term to search usernames with
     * @return array
     * A simple array of string usernames.
     * They are ordered alphabetically, but usernames that have the same first letter as the search term
     * are given higher priority (so they will appear first).
     */
    public function getSearchedUsernames(string $searchTerm): array {

        $statement = $this->db->prepare(<<<sql
            SELECT username
            FROM users
            WHERE username LIKE ?
            ORDER BY
                CASE
                    WHEN LEFT(username, 1) = LEFT(?, 1) THEN 0
                    ELSE 1
                END,
                username;
        sql);
        $statement->execute(["%$searchTerm%", "$searchTerm"]);

        // results are returned in the form [0=>['username'=>'bob'], 1=>['username'=>'jan']]
        $results2D = $statement->fetchAll(PDO::FETCH_ASSOC);

        // ...So flatten them to the form [0=>'bob', 1=>'jan']
        $results1D = [];
        foreach($results2D as $result) {
            $results1D[] = $result['username'];
        }
        return $results1D;
    }

    /**
     * Returns an array of 
     * @return array string usernames ordered alphabetically
     */
    public function getAllUsernames(): array {
        return $this->getSearchedUsernames('');
    }

    /**
     * @return array
     * Returns an arrray of total number of users, users registered in
     * the past week, and users registered today.
     */
    public function getUserAnalytics(): array {
        $statement = $this->db->query(<<<SQL
            SELECT
                (SELECT COUNT(*) FROM users) AS total_users,
                (SELECT COUNT(*) FROM users WHERE date_registered >= NOW() - INTERVAL 1 WEEK) AS registered_past_week,
                (SELECT COUNT(*) FROM users WHERE date_registered >= CURDATE()) AS registered_today
        SQL);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>
