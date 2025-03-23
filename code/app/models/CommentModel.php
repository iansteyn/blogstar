<?php
    class CommentModel {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function getComments($postId): array {
            $statement = $this->db->prepare(<<<sql
            SELECT *
            FROM comments
            WHERE post_id = :postId
            ORDER BY comment_date DESC
        sql);
        $statement->bindValue(":postId", $postId);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results ? $results : [];
    }

        public function createComment($commentData) {
            //TODO
        }

        public function updateComment($commentData) {
            //TODO
        }

        public function deleteComment($commentId) {
            //TODO
        }
    }
?>