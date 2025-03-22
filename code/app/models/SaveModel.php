<?php

class SaveModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getSavedPosts(string $username): array {
        // TODO
        return [];
    }

    /**
     * @param string $username
     * @param int $postId
     * @return bool true if save was successfully added to DB
     */
    public function addSave(string $username, int $postId) {
        $statement = $this->db->prepare(<<<sql
            INSERT INTO saves(username, post_id)
            VALUES (:username, :postId);
        sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":postId", $postId);
        return $statement->execute();
    }

    /**
     * @param string $username
     * @param int $postId
     * @return bool true if save was successfully removed from DB
     */
    public function removeSave(string $username, int $postId) {
        $statement = $this->db->prepare(<<<sql
            DELETE FROM saves
            WHERE username = :username AND post_id = :postId;
        sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":postId", $postId);
        return $statement->execute();
    }

    public function getNumSaves(int $postId) {
        $statement = $this->db->prepare(<<<sql
            SELECT COUNT(post_id)
            FROM saves
            WHERE post_id = :postId;
        sql);
        $statement->bindValue(":postId", $postId);

        $statement->execute();
        $result = $statement->fetch();
        return $result ? $result[0] : 0;
    }

}

?>