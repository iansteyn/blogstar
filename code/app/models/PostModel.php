<?php

class PostModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getPostById(int $postId): array {
        //XXX Temporary mock return value
        return [
            "postId" => "TODO should we even return this?",
            "username" => "sadiesmith",
            "title" => "Placeholder post title",
            "textContent" => "Placeholder post text content",
            "image" => "placeholder for image object",
            "date" => "2015-01-01"
        ];
    }

    public function getRecentPosts(): array {
        //TODO return array of recent posts from db
        // XXX Temporary mock return value
        return [
            $this->getPostById(1),
            $this->getPostById(1),
            $this->getPostById(1)
        ];
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