<?php
require_once __DIR__.'/../models/CommentModel.php';
require_once __DIR__.'/../services/AuthAccess.php';
require_once __DIR__.'/../services/AuthStatus.php';
require_once __DIR__.'/../services/ErrorService.php';

class CommentController {
    private $commentModel;

    public function __construct($db) {
        $this->commentModel = new CommentModel($db);
    }

    public function create($postId) {
        ErrorService::requirePostRequest();
        AuthAccess::restrictTo(['registered', 'admin']);

        $commentBody = trim($_POST['comment-body'] ?? '');
    
        $this->commentModel->createComment([
            'username'     => $_SESSION['username'], 
            'post_id'      => $postId, 
            'comment_body' => $commentBody
        ]);

        Redirector::route("/blog-post/$postId");
    }

    public function delete($commentId) {
        ErrorService::requirePostRequest();
        AuthAccess::restrictTo(['registered', 'admin']);

        $comment = $this->commentModel->getCommentById($commentId);

        if (! AuthStatus::isCurrentUser($comment['username']) or ! AuthStatus::isAdmin()) {
            Redirector::route('/home');
        }

        $this->commentModel->deleteComment($commentId);
        Redirector::route('/blog-post/'.$comment['post_id']);
    }
}
?>