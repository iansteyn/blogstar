<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';

class PostController {
    private $postModel;
    private $saveModel;
    private $likeModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
    }

    public function blogPost($postId) {

        $postData = $this->postModel->getPostById($postId);
        $postData['is_liked'] = true;
        $postData['is_saved'] = false;

        // This view uses: $postData
        require __DIR__.'/../views/specific-post-view.php';
    }

    public function create() {
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/create-view.php';
        }
        // Otherwise, handle the submission:
        else {
            //ammend this to hard-coded as needed
            $this->postModel->createPost([
                'username'   => "spooky",
                'post_title' => $_POST['post-title'],
                'post_body'  => $_POST['post-body'],
                'post_image' => "../photo/sadie-smith.jpg"

            ]);
            header('Location: /profile');
            exit;
        }
    }
}

?>