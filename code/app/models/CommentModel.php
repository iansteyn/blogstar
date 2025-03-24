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
            $statement = $this->db->prepare(<<<SQL
                INSERT INTO comments (username, post_id, comment_body)
                VALUES (:username, :post_id, :comment_body);
            SQL);
        
            $statement->bindValue(':username', $commentData['username']);
            $statement->bindValue(':post_id', $commentData['post_id']);
            $statement->bindValue(':comment_body', $commentData['comment_body']);
            $statement->execute();
        }

        public function updateComment($commentData) {
            //TODO
        }

        public function getCommentById($commentId) {
            $statement = $this->db->prepare(<<<sql
                SELECT *
                FROM comments
                WHERE comment_id = :commentId
            sql);
            $statement->bindValue(":commentId", $commentId);
            $statement->execute();
        
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null;
        }
        
        public function deleteComment($commentId) {
            $statement = $this->db->prepare(<<<SQL
                DELETE FROM comments
                WHERE comment_id = :commentId
            SQL);
            $statement->bindValue(':commentId', $commentId);
            $statement->execute();
        }
    }
?>