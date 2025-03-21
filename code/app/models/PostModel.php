<?php

class PostModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * @param int $postId
     * @return array{post_id, username, post_title, post_body, post_image, post_date}
     * Array representing data of a single post, or null if no post with that id exists.
     */
    public function getPostById(int $postId): ?array {
        $statement = $this->db->prepare(<<<sql
            SELECT *
            FROM posts
            WHERE post_id = :postId
        sql);
        $statement->bindValue(":postId", $postId);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }

    /**
     * @return array
     * Array of postData arrays, each with keys {post_id, username, post_title, post_body, post_image, post_date},
     * ordered by most recent post_date first.
     */
    public function getRecentPosts(): array {
        $statement = $this->db->query(<<<sql
            SELECT *
            FROM posts
            ORDER BY post_date DESC
        sql);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function getPopularPosts(): array {
        //TODO return array of popular posts from db
        return [];
    }

    public function createPost(array $postData) {
        // If form is not submitted, just display the page
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/create-view.php';
        }else{
            $statement = $this->db->prepare(<<<SQL
                INSERT INTO posts(post_title, post_body, post_image)
                VALUES(?, ?, ?);
                SQL);

            $statement->bindValue(1, $postData['post_title']);
            $statement->bindValue(2, $postData['post_body']);
            $statement->bindValue(3, $postData['post_image']);
            $statement->execute();

            header('Location: /profile');
            exit;
        } 
    }

    public function updatePost(array $postData) {
        //TODO
    }

    public function deletePost(int $postId) {
        //TODO
    }
}

?>