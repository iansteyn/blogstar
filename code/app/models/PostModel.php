<?php

class PostModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getPostById(int $postId): array {
        //TODO get post object from db
        return [];
    }

    public function getRecentPosts(): array {
        //TODO return array of recent posts from db
        return [];
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