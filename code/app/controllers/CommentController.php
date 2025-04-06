<?php
require_once __DIR__.'/../models/CommentModel.php';
require_once __DIR__.'/../models/UserModel.php';

class CommentController {
    private $commentModel;
    private $userModel;

    public function __construct($db) {
        $this->commentModel = new CommentModel($db);
        $this->userModel = new UserModel($db);
    }

    public function create($postId) {
        AuthService::requireAuth(['registered', 'admin']);
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('location: '.routeUrl('/home'));
            exit;
        }
    
    
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
        AuthService::requireAuth(['registered', 'admin']);
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header('location: '.routeUrl('/home'));
        exit;
    }

    $comment = $this->commentModel->getCommentById($commentId);

    if ($_SESSION['username'] !== $comment['username'] && $_SESSION['role'] !== 'admin') {
        header('location: '.routeUrl('/home'));
        exit;
    }
    $this->commentModel->deleteComment($commentId);
    header('location: '.routeUrl("/blog-post/{$comment['post_id']}"));
    exit;

    }

    //Handles editing a comment.
    public function edit($commentId) {
        
    }
}
?>