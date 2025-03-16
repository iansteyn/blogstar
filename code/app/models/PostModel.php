<?php

class PostModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    function getPostById(int $postId): Post {
        //TODO get post object from db
    }

    function getRecentPosts(): array {
        //TODO return array of recent posts from db
    }

    function getPopularPosts(): array {
        //TODO return array of popular posts from db

    }
}

?>