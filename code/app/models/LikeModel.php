<?php

class LikeModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addLike(string $username, int $postId) {
        $statement = $this->db->prepare(<<<sql
            INSERT INTO likes(username, post_id)
            VALUES (:username, :postId);
        sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":postId", $postId);
        $statement->execute();
    }

    public function removeLike(string $username, int $postId) {
        //TODO
    }
}

?>