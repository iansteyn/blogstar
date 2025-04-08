<?php
require_once __DIR__.'/../models/CommentModel.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../services/AuthService.php';
require_once __DIR__.'/../services/ErrorService.php';

class CommentController {
    private $commentModel;
    private $userModel;

    public function __construct($db) {
        $this->commentModel = new CommentModel($db);
        $this->userModel = new UserModel($db);
    }

    public function create($postId) {
        ErrorService::requirePostRequest();
        AuthService::requireAuth(['registered', 'admin']);

        $commentBody = trim($_POST['comment-body'] ?? '');
    
        $this->commentModel->createComment([
            'username'     => $_SESSION['username'], 
            'post_id'      => $postId, 
            'comment_body' => $commentBody
        ]);
    
        header('location: '.routeUrl("/blog-post/$postId"));
        exit;
    }

    public function delete($commentId) {
        ErrorService::requirePostRequest();
        AuthService::requireAuth(['registered', 'admin']);

        $comment = $this->commentModel->getCommentById($commentId);

        if ($_SESSION['username'] !== $comment['username'] && $_SESSION['role'] !== 'admin') {
            header('location: '.routeUrl('/home'));
            exit;
        }

        $this->commentModel->deleteComment($commentId);
        header('location: '.routeUrl("/blog-post/{$comment['post_id']}"));
        exit;

    }
}
?>