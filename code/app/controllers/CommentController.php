<?php
require_once __DIR__.'/../models/CommentModel.php';

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

        Redirect::to("/blog-post/$postId");
    }

    public function delete($commentId) {
        ErrorService::requirePostRequest();
        AuthAccess::restrictTo(['registered', 'admin']);

        $comment = $this->commentModel->getCommentById($commentId);

        if (! AuthStatus::isCurrentUser($comment['username']) or ! AuthStatus::isAdmin()) {
            Redirect::to('/home');
        }

        $this->commentModel->deleteComment($commentId);
        Redirect::to('/blog-post/'.$comment['post_id']);
    }
}
?>