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
        //TODO
    }

    public function updatePost(array $postData) {
        //TODO
    }

    public function deletePost(int $postId) {
        //TODO
    }
}

?>