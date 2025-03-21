<?php

class LikeModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addLike(string $username, int $postId) {
        //TODO
    }

    public function removeLike(string $username, int $postId) {
        //TODO
    }
}

?>