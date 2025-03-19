<?php
require __DIR__.'/../models/PostModel.php';
require __DIR__.'/../models/SaveModel.php';
require __DIR__.'/../models/LikeModel.php';

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

        require __DIR__.'/../views/single-post-view.php';
    }
}

?>