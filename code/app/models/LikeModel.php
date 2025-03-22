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
        $statement = $this->db->prepare(<<<sql
            DELETE FROM likes
            WHERE username = :username AND post_id = :postId;
        sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":postId", $postId);
        $statement->execute();
    }

    public function doesUserLikePost(string $username, int $postId): bool {
        $statement = $this->db->prepare(<<<sql
            SELECT username
            FROM likes
            WHERE username = ? AND post_id = ?;
        sql);
        $statement->execute([$username, $postId]);

        $result = $statement->fetch();
        return boolval($result);
    }

    public function getNumLikes(int $postId) {
        $statement = $this->db->prepare(<<<sql
            SELECT COUNT(post_id)
            FROM likes
            WHERE post_id = :postId;
        sql);
        $statement->bindValue(":postId", $postId);

        $statement->execute();
        $result = $statement->fetch();
        return $result ? $result[0] : 0;
    }
}

?>