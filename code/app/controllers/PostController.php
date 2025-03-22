<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../models/UserModel.php';

class PostController {
    private $postModel;
    private $userModel;
    private $saveModel;
    private $likeModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
        $this->userModel = new UserModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
    }

    public function blogPost($postId) {

        $postData = $this->postModel->getPostById($postId);
        $postData['is_liked'] = true;
        $postData['is_saved'] = false;

        $userData = $this->userModel->getUserByUsername($postData['username']);

        // This view uses: $postData, $userData
        require __DIR__.'/../views/specific-post-view.php';
    }
}

?>