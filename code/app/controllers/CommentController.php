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

    //Handles creating a new comment.
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->commentModel->createComment([
                'post_id' => $_POST['post_id'],
                'username' => $_SESSION['username'], 
                'comment_body' => $_POST['comment_body']
            ]);
            header('Location: /blog-post/' . $_POST['post_id']);
            exit;
        }
    }

    //Handles deleting a comment.
    
    public function delete($commentId) {
        
    }

    //Handles editing a comment.
     
    public function edit($commentId) {
        
    }
}
?>