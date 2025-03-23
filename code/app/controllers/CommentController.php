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

    public function create() {
        AuthService::requireAuth(['registered', 'admin']);
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: /home');
            exit;
        }
        $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
        $commentBody = trim($_POST['comment-body'] ?? '');
    
        $this->commentModel->createComment([
            'username' => $_SESSION['username'], 
            'post_id' => $postId, 
            'comment_body' => $commentBody
        ]);
    
        header('Location: /blog-post/' . $postId);
        exit;
    }

    //Handles deleting a comment.
    public function delete($commentId) {
        
    }

    //Handles editing a comment.
    public function edit($commentId) {
        
    }
}
?>