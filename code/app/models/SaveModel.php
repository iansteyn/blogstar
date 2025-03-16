<?php

class SaveModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getSavedPosts(string $username): array {
        // TODO
        return [];
    }

    public function addSave(string $username, int $postId) {
        // TODO
    }

    public function removeSave(string $username, int $postId) {
        // TODO
    }

}

?>