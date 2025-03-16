<?php
    class CommentModel {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function getComments($postId): array {
            //TODO
            return [];
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