<?php

class PostModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    function getPostById(int $postId): array {
        //TODO get post object from db
        return [];
    }

    function getRecentPosts(): array {
        //TODO return array of recent posts from db
        return [];
    }

    function getPopularPosts(): array {
        //TODO return array of popular posts from db
        return [];

    }
}

?>