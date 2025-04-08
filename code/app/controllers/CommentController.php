<?php
require_once __DIR__.'/../models/CommentModel.php';
require_once __DIR__.'/../models/PostModel.php';

class CommentController {
    private $commentModel;
    private $postModel;

    public function __construct($db) {
        $this->commentModel = new CommentModel($db);
        $this->postModel = new PostModel($db);
    }

    public function create($postId) {
        ErrorService::requirePostRequest();
        AuthAccess::restrictTo(['registered', 'admin']);

        if (! ctype_digit($postId)) {
            ErrorService::badRequest();
        }
        if (! $this->postModel->postExists($postId)) {
            ErrorService::notFound();
        }

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

        if (! ctype_digit($commentId)) {
            ErrorService::badRequest();
        }
        if (! $this->commentModel->commentExists($commentId)) {
            ErrorService::notFound();
        }

        $comment = $this->commentModel->getCommentById($commentId);

        if (! AuthStatus::isCurrentUser($comment['username']) or ! AuthStatus::isAdmin()) {
            ErrorService::forbidden();
        }

        $this->commentModel->deleteComment($commentId);
        Redirect::to('/blog-post/'.$comment['post_id']);
    }
}
?>